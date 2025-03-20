<?php

namespace App\Livewire\Orders;

use App\Traits\Set;
use App\Traits\Table;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersIndex extends Component
{
    use Table;
    use Set;
    use WithPagination;

    public int $paginate = 10;

    public function findOrdersTopping(?int $ordersId): Collection {
        return DB::table(Table::$ordersTopping)->where('order_id', $ordersId)->get();
    }

    public function render()
    {
        return view('livewire.orders.orders-index', [
            'ordersData' => DB::table(Table::$orders)->orderBy('id', 'desc')->paginate($this->paginate)
        ]);
    }
}

