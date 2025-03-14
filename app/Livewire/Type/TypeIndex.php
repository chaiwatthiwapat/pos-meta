<?php

namespace App\Livewire\Type;

use App\Traits\Set;
use App\Traits\Table;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TypeIndex extends Component
{
    use Table;
    use Set;

    public int $paginate = 10;

    // @variable
    public ?string $name = null;
    public ?float $price = null;

    public ?int $editId = null;
    public ?string $nameEdit = '';
    public ?float $priceEdit = null;

    // @insert
    public function insert(): void {
        $this->name = Set::string($this->name);

        $tbType = Table::$type;
        $this->validate([
            'name' => "required|string|max:20|unique:{$tbType},name",
            'price' => 'required|max:7',
        ], [
            'name.required' => 'กรอกชื่อ',
            'name.string' => 'ห้ามใช้ตัวอักษรพิเศษ',
            'name.max' => 'ชื่อสูงสุด 20 ตัว',
            'name.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'price.required' => 'กรอกราคา',
            'price.max' => 'ราคาสูงสุด (9999.99)',
        ]);

        try {
            DB::table(Table::$type)
                ->insert([
                    'name' => $this->name,
                    'price' => Set::number($this->price),
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
            DB::table(Table::$type)->where('id', $id)->delete();
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
        $query = DB::table(Table::$type)->where('id', $id)->first();

        $this->editId = $id;
        $this->nameEdit = $query?->name;
        $this->priceEdit = $query?->price;
    }

    public function clearFormEdit(): void {
        $this->editId = null;
        $this->nameEdit = '';
        $this->priceEdit = null;
        $this->clearErrors();
    }
    // @end edit

    // @update
    public function update(): void {
        $this->nameEdit = Set::string($this->nameEdit);

        $tbType = Table::$type;
        $this->validate([
            'nameEdit' => "required|string|max:20|unique:{$tbType},name,$this->editId,id",
            'priceEdit' => 'required|max:7',
        ], [
            'nameEdit.required' => 'กรอกชื่อ',
            'nameEdit.string' => 'ห้ามใช้ตัวอักษรพิเศษ',
            'nameEdit.max' => 'ชื่อสูงสุด 20 ตัว',
            'nameEdit.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'priceEdit.required' => 'กรอกราคา',
            'priceEdit.max' => 'ราคาสูงสุด (9999.99)',
        ]);

        try {
            DB::table(Table::$type)
                ->where('id', $this->editId)
                ->update([
                    'name' => $this->nameEdit,
                    'price' => Set::number($this->priceEdit),
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
        return view('livewire.type.type-index', [
            'data' => DB::table(Table::$type)->latest()->paginate($this->paginate)
        ]);
    }
}
