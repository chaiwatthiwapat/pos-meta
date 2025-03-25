<?php

namespace App\Livewire\Orders;

use App\Exports\OrdersExcel;
use App\Traits\Set;
use App\Traits\Table;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class OrdersIndex extends Component
{
    use Table;
    use Set;
    use WithPagination;

    public int $paginate = 10;

    public function findOrdersTopping(?int $ordersId): Collection {
        return DB::table(Table::$ordersTopping)->where('orders_id', $ordersId)->get();
    }

    public function countOrdersDetail(?int $ordersId): int {
        return DB::table(Table::$ordersDetail)->where('orders_id', $ordersId)->count();
    }


    // @delete
    public function delete(?int $id = null): void {
        DB::beginTransaction();

        try {
            $query = DB::table(Table::$orders)->where('id', $id)->first();

            if($ordersId = $query?->orders_id) {
                DB::table(Table::$orders)->where('orders_id', $ordersId)->delete();
                DB::table(Table::$ordersDetail)->where('orders_id', $ordersId)->delete();
                DB::table(Table::$ordersTopping)->where('orders_id', $ordersId)->delete();
                $this->dispatch('alert', ['message' => '<div class="text-green-700">ลบสำเร็จ</div>']);
                $this->dispatch('hidden-delete');

                DB::commit();
            }
        }
        catch(\Exception $e) {
            DB::rollBack();

            $message = <<<HTML
                <div class="text-gray-600">ลบ</div>
                <div class="text-red-700">เกิดข้อผิดพลาดบางอย่าง</div>
                <div class="text-red-700">กรุณาลองใหม่</div>
            HTML;
            $this->dispatch('alert', ['message' => $message]);

            $this->dispatch('hidden-delete');
        }
    }
    // @end delete

    // @excel
    public function excel() {
        $orders = DB::table(Table::$orders)
            ->leftJoin(Table::$ordersDetail, Table::$orders.'.orders_id', '=', Table::$ordersDetail.'.orders_id')
            ->get();
        
        $orders = $orders->groupBy('orders_id');

        // foreach($orders as $row) {
        //     $ordersDetail = DB::table(Table::$ordersDetail)
        // }

        $ordersDetail = DB::table(Table::$ordersDetail)->get();
        $ordersTopping = DB::table(Table::$ordersTopping)->get();

        $data = [
            'orders' => $orders, 
            'ordersDetail' => $ordersDetail, 
            'ordersTopping' => $ordersTopping
        ];
        // dd($data);
        
        return Excel::download(new OrdersExcel($data), 'orders.xlsx');
    }
    // @end excel

    public function render()
    {
        return view('livewire.orders.orders-index', [
            'orders' => DB::table(Table::$orders)->orderBy('id', 'desc')->paginate($this->paginate),
            'ordersDetail' => DB::table(Table::$ordersDetail)->orderBy('id', 'desc')->paginate($this->paginate),
        ]);
    }
}

