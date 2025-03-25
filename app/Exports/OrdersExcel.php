<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrdersExcel implements FromView
{
    protected array $data = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function view(): View {
        return view('exports.orders-excel', [
            'data' => $this->data
        ]);
    }
}
