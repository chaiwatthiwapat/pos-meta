<?php

namespace App\Livewire\Pos;

use \App\Traits\Table;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PosIndex extends Component
{
    use Table;

    public int $paginate = 10;
    public ?object $productModalData = null;
    public ?int $id = null;
    public ?string $name = '';
    public ?int $price = 0;
    public int $qty = 1;

    public function productModal(?int $id) {
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
        $this->productModalData = $data;
    }

    public function render()
    {
        $products = DB::table(Table::$product)->latest()->paginate($this->paginate);

        return view('livewire.pos.pos-index', ['products' => $products]);
    }
}
