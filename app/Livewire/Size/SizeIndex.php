<?php

namespace App\Livewire\Size;

use App\Traits\Set;
use App\Traits\Table;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SizeIndex extends Component
{
    use Table;
    use Set;

    public int $paginate = 10;

    // @variable
    public ?string $sizeName = null;
    public ?float $sizePrice = null;

    public ?int $editId = null;
    public ?string $sizeNameEdit = '';
    public ?float $sizePriceEdit = null;

    // @insert
    public function insert(): void {
        $this->sizeName = Set::string($this->sizeName);

        $tbSize = Table::$size;
        $this->validate([
            'sizeName' => "required|string|max:20|unique:{$tbSize},name",
            'sizePrice' => 'required|max:7',
        ], [
            'sizeName.required' => 'กรอกชื่อ',
            'sizeName.string' => 'ห้ามใช้ตัวอักษรพิเศษ',
            'sizeName.max' => 'ชื่อสูงสุด 20 ตัว',
            'sizeName.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'sizePrice.required' => 'กรอกราคา',
            'sizePrice.max' => 'ราคาสูงสุด (9999.99)',
        ]);

        try {
            DB::table(Table::$size)
                ->insert([
                    'name' => $this->sizeName,
                    'price' => Set::number($this->sizePrice),
                    'created_at' => now()
                ]);

            $this->dispatch('alert', ['message' => '<div class="text-green-700">เพิ่มสำเร็จ</div>']);
            $this->clearFormInsert();
            $this->dispatch('hidden-insert');
        }
        catch(\Exception $e) {
            $message = <<<HTML
                <div class="text-gray-600">เพิ่ม</div>
                <div class="text-red-700">เกิดข้อผิดพลาดบางอย่าง</div>
                <div class="text-red-700">กรุณาลองใหม่</div>
            HTML;
            $this->dispatch('alert', ['message' => $message]);
        }
    }

    public function clearFormInsert(): void {
        $this->productName = '';
        $this->productPrice = '';
        $this->productImage = null;
        $this->previewImage = '';
        $this->clearErrors();
    }
    // @end insert

    // @delete
    public function delete(?int $id = null): void {
        try {
            DB::table(Table::$size)->where('id', $id)->delete();
            $this->dispatch('alert', ['message' => '<div class="text-green-700">ลบสำเร็จ</div>']);
            $this->dispatch('hidden-delete');
        }
        catch(\Exception $e) {
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

    // @edit
    public function edit(?int $id = null): void {
        $query = DB::table(Table::$size)->where('id', $id)->first();

        $this->editId = $id;
        $this->sizeNameEdit = $query?->name;
        $this->sizePriceEdit = $query?->price;
    }

    public function clearFormEdit(): void {
        $this->editId = null;
        $this->sizeNameEdit = '';
        $this->sizePriceEdit = null;
        $this->clearErrors();
    }
    // @end edit

    // @update
    public function update(): void {
        $this->sizeNameEdit = Set::string($this->sizeNameEdit);

        $tbSize = Table::$size;
        $this->validate([
            'sizeNameEdit' => "required|string|max:20|unique:{$tbSize},name,$this->editId,id",
            'sizePriceEdit' => 'required|max:7',
        ], [
            'sizeNameEdit.required' => 'กรอกชื่อ',
            'sizeNameEdit.string' => 'ห้ามใช้ตัวอักษรพิเศษ',
            'sizeNameEdit.max' => 'ชื่อสูงสุด 20 ตัว',
            'sizeNameEdit.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'sizePriceEdit.required' => 'กรอกราคา',
            'sizePriceEdit.max' => 'ราคาสูงสุด (9999.99)',
        ]);

        try {
            DB::table(Table::$size)
                ->where('id', $this->editId)
                ->update([
                    'name' => $this->sizeNameEdit,
                    'price' => Set::number($this->sizePriceEdit),
                    'updated_at' => now()
                ]);

            $this->dispatch('alert', ['message' => '<div class="text-green-700">อัพเดทสำเร็จ</div>']);
            $this->clearFormEdit();
            $this->dispatch('hidden-edit');
        }
        catch(\Exception $e) {
            $message = <<<HTML
                <div class="text-gray-600">อัพเดท</div>
                <div class="text-red-700">เกิดข้อผิดพลาดบางอย่าง</div>
                <div class="text-red-700">กรุณาลองใหม่</div>
            HTML;
            $this->dispatch('alert', ['message' => $message]);
        }
    }
    // @end update

    public function clearErrors(): void {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.size.size-index', [
            'sizeData' => DB::table(Table::$size)->latest()->paginate($this->paginate)
        ]);
    }
}
