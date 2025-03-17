<?php

namespace App\Livewire\Pos;

use \App\Traits\Table;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PosIndex extends Component
{
    use Table;

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

    public function render()
    {
        $products = DB::table(Table::$product)->latest()->paginate($this->paginate);

        return view('livewire.pos.pos-index', ['products' => $products]);
    }
}
