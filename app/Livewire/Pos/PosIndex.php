<?php

namespace App\Livewire\Pos;

use \App\Traits\Table;
use App\Traits\Set;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PosIndex extends Component
{
    use Table;
    use Set;
    use WithPagination;

    public int $paginate = 10;
    public ?object $productData = null;
    public ?int $id = null;
    public ?string $name = '';
    public ?int $price = 0;
    public int $qty = 1;

    public function __construct() {
        $this->getSize();
        $this->getType();
        $this->getTopping();
    }

    public function sizes(): Collection {
        return collect(session('sizes'));
    }

    public function types(): Collection {
        return collect(session('types'));
    }

    public function toppings(): Collection {
        return collect(session('toppings'));
    }

    public function product(?int $id): void {
        $query = DB::table(Table::$product)
            ->where('id', $id)
            ->first();

        $data = (object) [
            'name' => $query?->name,
            'image' => $query?->image
        ];

        $this->id = $id;
        $this->name = $query?->name;
        $this->price = $query?->price;
        $this->qty = 1;
        $this->productData = $data;
    }

    public function getSize(): void {
        $query = DB::table(Table::$size)->get();
        session(['sizes' => $query]);
    }

    public function getType(): void {
        $query = DB::table(Table::$type)->get();
        session(['types' => $query]);
    }

    public function getTopping(): void {
        $query = DB::table(Table::$topping)->get();
        session(['toppings' => $query]);
    }

    // @insert
    public function ordersInsert(array $data, array $money): void {
        DB::beginTransaction();

        try {
            $date = Carbon::now()->format('Ymd');
            $ordersId = (int) ($date."00001"); // ถ้ายังไม่เคยมี
            $lastOrders = DB::table(Table::$orders)->select('orders_id')->orderBy('id', 'desc')->first();
            if($lastOrdersId = $lastOrders?->orders_id) {
                $ordersId = sprintf('%05d', (int) substr($lastOrdersId, 8) + 1); // 00001 => 00002
                $ordersId = (int) ($date.$ordersId); // '20250301' + '00001' = '2025030100001'
            }
            $totalAmount = 0;

            foreach($data as $index => $row) {
                $product = (object) $row['product'];
                $size = (object) $row['size'];
                $type = (object) $row['type'];
                $topping = (array) $row['topping'];
                $amount = $row['amount'];
                $totalAmount += Set::number($amount);
                $ordersDetailId = sprintf("%s%03d", $ordersId, $index);

                $toppings = collect($topping['name'])
                    ->map(function ($name, $index) use ($topping) {
                        // ตรวจสอบว่ามี price ที่ index เดียวกัน
                        if(isset($topping['price'][$index])) {
                            return (object) [
                                'name' => $name,
                                'price' => $topping['price'][$index],
                            ];
                        }
                        return null;
                    })
                    ->filter() // กรองค่า null ออก
                    ->values(); // เรียง index ใหม่ 0,1,2,...

                DB::table(Table::$ordersDetail)
                    ->insert([
                        'orders_id' => $ordersId,
                        'product_name' => Set::string($product->name),
                        'product_price' => Set::number($product->price),
                        'size_name' => Set::string($size->name),
                        'size_price' => Set::number($size->price),
                        'type_name' => Set::string($type->name),
                        'type_price' => Set::number($type->price),
                        'quantity' => Set::number($product->qty),
                        'amount' => Set::number($amount),
                        'orders_detail_id' => $ordersDetailId,
                        'created_at' => now()
                    ]);

                foreach($toppings as $topping) {
                    DB::table(Table::$ordersTopping)
                        ->insert([
                            'orders_id' => $ordersId,
                            'orders_detail_id' => $ordersDetailId,
                            'topping_name' => Set::string($topping->name),
                            'topping_price' => Set::number($topping->price),
                            'created_at' => now()
                        ]);
                }
            }

            DB::table(Table::$orders)
                ->insert([
                    'orders_id' => $ordersId,
                    'sale_name' => Auth::user()->name,
                    'total_amount' => Set::number($totalAmount),
                    'get_money' => Set::number($money['get_money']),
                    'change_money' => Set::number($money['change_money']),
                    'created_at' => now()
                ]);

            $this->dispatch('alert', ['message' => '<div class="text-green-700">สำเร็จ</div>']);
            $this->dispatch('clear-cart');
            $this->dispatch('hidden-payment');

            DB::commit();
        }
        catch(\Exception $e) {
            DB::rollBack();
            throw $e;

            $message = <<<HTML
                <div class="text-red-700">เกิดข้อผิดพลาดบางอย่าง</div>
                <div class="text-red-700">กรุณาลองใหม่</div>
            HTML;
            $this->dispatch('alert', ['message' => $message]);
        }
    }
    // @end insert

    public function render()
    {
        return view('livewire.pos.pos-index', [
            'products' => DB::table(Table::$product)->orderBy('id', 'desc')->paginate($this->paginate)
        ]);
    }
}
