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
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OrdersIndex extends Component
{
    use Table;
    use Set;
    use WithPagination;

    public int $paginate = 10;

    public function mount() {
        session(['ordersBills' => null]);
    }

    public function findOrdersTopping(?int $ordersId): Collection {
        return DB::table(Table::$ordersTopping)->where('orders_id', $ordersId)->get();
    }

    public function countOrdersDetail(?int $ordersId): int {
        return DB::table(Table::$ordersDetail)->where('orders_id', $ordersId)->count();
    }

    public function ordersBills(): ?object {
        return session('ordersBills');
    }

    public function ordersDetailBills(): Collection {
        return collect(session('ordersDetailBills'));
    }

    public function toppingsGrouped(): Collection {
        return collect(session('toppingsGrouped'));
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
    public function excel(): BinaryFileResponse {
        $orders = DB::table(Table::$orders)
            ->leftJoin(Table::$ordersDetail, Table::$orders.'.orders_id', '=', Table::$ordersDetail.'.orders_id')
            ->get();

        $toppingsGrouped = DB::table(Table::$ordersTopping)
            ->get()
            ->groupBy('orders_detail_id');

        $orders = $orders->groupBy('orders_id');

        $data = [
            'orders' => $orders,
            'toppingsGrouped' => $toppingsGrouped
        ];
        // dd($data);

        return Excel::download(new OrdersExcel($data), 'orders.xlsx');
    }
    // @end excel

    public function bills(?int $ordersId) {
        $orders = DB::table(Table::$orders)->where('orders_id', $ordersId)->first();
        $ordersDetail = DB::table(Table::$ordersDetail)->where('orders_id', $ordersId)->get();
        $toppingsGrouped = DB::table(Table::$ordersTopping)
            ->get()
            ->groupBy('orders_detail_id');

        session(['ordersBills' => $orders]);
        session(['ordersDetailBills' => $ordersDetail]);
        session(['toppingsGrouped' => $toppingsGrouped]);
    }

    public function render()
    {
        return view('livewire.orders.orders-index', [
            'orders' => DB::table(Table::$orders)->orderBy('id', 'desc')->paginate($this->paginate),
            'ordersDetail' => DB::table(Table::$ordersDetail)->orderBy('id', 'desc')->paginate($this->paginate),
        ]);
    }
}

