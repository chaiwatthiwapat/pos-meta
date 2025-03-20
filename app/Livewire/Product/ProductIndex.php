<?php

namespace App\Livewire\Product;

use App\Traits\Set;
use App\Traits\Table;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithFileUploads;
    use Set;
    use Table;
    use WithPagination;

    public int $paginate = 5;

    // @model
    public ?int $id = null;
    public ?UploadedFile $image = null;
    public ?string $previewImage = '';
    public string $name = '';
    public string $price = '';

    // @insert
    public function insert(): void {
        $this->name = Set::string($this->name);

        $tbProduct = Table::$product;
        $this->validate([
            'name' => "required|string|max:50|unique:{$tbProduct},name",
            'price' => 'required|numeric|max:9999',
            'image' => 'required|image|max:12288'
        ], [
            'name.required' => 'กรอกชื่อ',
            'name.string' => 'ห้ามใช้ตัวอักษรพิเศษ',
            'name.max' => 'ชื่อสูงสุด 50 ตัว',
            'name.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'price.required' => 'กรอกราคา',
            'price.max' => 'ราคาสูงสุด (9999)',
            'price.numeric' => 'ตัวเลขเท่านั้น',
            'image.required' => 'เพิ่มภาพ',
            'image.image' => 'ไฟล์ภาพเท่านั้น',
            'image.max' => 'สูงสุด 12MB',
        ]);

        DB::beginTransaction();

        try {
            $imageName = 'product'.Set::newFileName($this->image);

            DB::table(Table::$product)
                ->insert([
                    'name' => Set::string($this->name),
                    'price' => Set::number($this->price),
                    'image' => $imageName,
                    'created_at' => now()
                ]);

            $this->image->storeAs('product-images', $imageName, 'public');

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
        $this->price = '';
        $this->image = null;
        $this->previewImage = '';
        $this->clearErrors();
    }
    // @end insert

    // @delete
    public function delete(?int $id = null): void {
        DB::beginTransaction();

        try {
            DB::table(Table::$product)->where('id', $id)->delete();
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
        $query = DB::table(Table::$product)->where('id', $id)->first();

        $this->id = $id;
        $this->name = $query?->name;
        $this->price = $query?->price;
        $this->price = $query?->price;
        $this->previewImage = "/storage/product-images/{$query?->image}";
    }
    // @end edit

    // @update
    public function update(): void {
        $this->name = Set::string($this->name);

        $tbProduct = Table::$product;
        $this->validate([
            'name' => "required|string|max:50|unique:{$tbProduct},name,$this->id,id",
            'price' => 'required|numeric|max:9999',
            'image' => 'nullable|image|max:12288'
        ], [
            'name.required' => 'กรอกชื่อ',
            'name.string' => 'ห้ามใช้ตัวอักษรพิเศษ',
            'name.max' => 'ชื่อสูงสุด 50 ตัว',
            'name.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'price.required' => 'กรอกราคา',
            'price.max' => 'ราคาสูงสุด (9999)',
            'price.numeric' => 'ตัวเลขเท่านั้น',
            'image.image' => 'ไฟล์ภาพเท่านั้น',
            'image.max' => 'สูงสุด 12MB',
        ]);

        DB::beginTransaction();

        try {
            $update = [
                'name' => Set::string($this->name),
                'price' => Set::number($this->price),
                'updated_at' => now()
            ];

            if($this->image) {
                $update = array_merge($update, ['image' => 'prodcut'.Set::newFileName($this->image)]);
            }

            DB::table(Table::$product)->where('id', $this->id)->update($update);

            if(!empty($this->image)) {
                $this->image->storeAs('product-images', $image, 'public');
            }

            $this->dispatch('alert', ['message' => '<div class="text-green-700">อัพเดทสำเร็จ</div>']);
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
        return view('livewire.product.product-index', [
            'productData' => DB::table(Table::$product)->latest()->paginate($this->paginate)
        ]);
    }
}
