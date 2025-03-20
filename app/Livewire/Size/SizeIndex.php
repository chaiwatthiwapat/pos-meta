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

    // @model
    public ?string $name = null;
    public ?int $price = null;
    public ?int $id = null;

    // @insert
    public function insert(): void {
        $this->name = Set::string($this->name);

        $tbSize = Table::$size;
        $this->validate([
            'name' => "required|string|max:50|unique:{$tbSize},name",
            'price' => 'required|numeric|max:9999',
        ], [
            'name.required' => 'กรอกชื่อ',
            'name.string' => 'ห้ามใช้ตัวอักษรพิเศษ',
            'name.max' => 'ชื่อสูงสุด 50 ตัว',
            'name.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'price.required' => 'กรอกราคา',
            'price.max' => 'ราคาสูงสุด (9999)',
            'price.numeric' => 'ตัวเลขเท่านั้น',
        ]);

        DB::beginTransaction();

        try {
            DB::table(Table::$size)
                ->insert([
                    'name' => Set::string($this->name),
                    'price' => Set::number($this->price),
                    'created_at' => now()
                ]);

            $this->dispatch('alert', ['message' => '<div class="text-green-700">เพิ่มสำเร็จ</div>']);
            $this->clearForm();
            $this->dispatch('hidden-insert');

            DB::commit();
        }
        catch(\Exception $e) {
            DB::rollBack();

            $message = <<<HTML
                <div class="text-gray-600">เพิ่ม</div>
                <div class="text-red-700">เกิดข้อผิดพลาดบางอย่าง</div>
                <div class="text-red-700">กรุณาลองใหม่</div>
            HTML;
            $this->dispatch('alert', ['message' => $message]);
        }
    }

    public function clearForm(): void {
        $this->id = null;
        $this->name = '';
        $this->price = null;
        $this->clearErrors();
    }
    // @end insert

    // @delete
    public function delete(?int $id = null): void {
        DB::beginTransaction();

        try {
            DB::table(Table::$size)->where('id', $id)->delete();
            $this->dispatch('alert', ['message' => '<div class="text-green-700">ลบสำเร็จ</div>']);
            $this->dispatch('hidden-delete');

            DB::commit();
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

    // @edit
    public function edit(?int $id = null): void {
        $query = DB::table(Table::$size)->where('id', $id)->first();

        $this->id = $id;
        $this->name = $query?->name;
        $this->price = $query?->price;
    }
    // @end edit

    // @update
    public function update(): void {
        $this->name = Set::string($this->name);

        $tbSize = Table::$size;
        $this->validate([
            'name' => "required|string|max:50|unique:{$tbSize},name,$this->id,id",
            'price' => 'required|numeric|max:9999',
        ], [
            'name.required' => 'กรอกชื่อ',
            'name.string' => 'ห้ามใช้ตัวอักษรพิเศษ',
            'name.max' => 'ชื่อสูงสุด 50 ตัว',
            'name.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'price.required' => 'กรอกราคา',
            'price.max' => 'ราคาสูงสุด (9999)',
            'price.numeric' => 'ตัวเลขเท่านั้น',
        ]);

        DB::beginTransaction();

        try {
            DB::table(Table::$size)
                ->where('id', $this->id)
                ->update([
                    'name' => Set::string($this->name),
                    'price' => Set::number($this->price),
                    'updated_at' => now()
                ]);

            $this->dispatch('alert', ['message' => '<div class="text-green-700">อัพเดทสำเร็จ</div>']);
            $this->clearForm();
            $this->dispatch('hidden-edit');

            DB::commit();
        }
        catch(\Exception $e) {
            DB::rollBack();

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
