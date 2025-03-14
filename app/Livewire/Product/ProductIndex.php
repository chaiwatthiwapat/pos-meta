<?php

namespace App\Livewire\Product;

use App\Traits\Set;
use App\Traits\Table;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductIndex extends Component
{
    use WithFileUploads;
    use Set;
    use Table;

    public ?UploadedFile $image = null;
    public ?string $previewImage = '';
    public string $name = '';
    public string $price = '';
    public int $paginate = 10;
    public bool $priceDecimal = false;

    public ?int $editId = null;
    public ?UploadedFile $imageEdit = null;
    public ?string $previewImageEdit = '';
    public ?string $oldImageName = '';
    public ?string $nameEdit = '';
    public ?string $priceEdit = '';

    // @insert
    public function insert(): void {
        $this->name = Set::string($this->name);

        $tbProduct = Table::$product;
        $this->validate([
            'name' => "required|string|max:20|unique:{$tbProduct},name",
            'price' => 'required|max:7',
            'image' => 'required|image|max:12288'
        ], [
            'name.required' => 'กรอกชื่อ',
            'name.string' => 'ห้ามใช้ตัวอักษรพิเศษ',
            'name.max' => 'ชื่อสูงสุด 20 ตัว',
            'name.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'price.required' => 'กรอกราคา',
            'price.max' => 'ราคาสูงสุด (9999.99)',
            'image.required' => 'เพิ่มภาพ',
            'image.image' => 'ไฟล์ภาพเท่านั้น',
            'image.max:12288' => 'สูงสุด 12MB',
        ]);

        try {
            $imageName = 'product'.Set::newFileName($this->image);

            DB::table(Table::$product)
                ->insert([
                    'name' => $this->name,
                    'price' => Set::number($this->price),
                    'image' => $imageName,
                    'created_at' => now()
                ]);

            $this->image->storeAs('product-images', $imageName, 'public');

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
        $this->name = '';
        $this->price = '';
        $this->image = null;
        $this->previewImage = '';
        $this->clearErrors();
    }
    // @end insert

    // @delete
    public function delete(?int $id = null): void {
        try {
            DB::table(Table::$product)->where('id', $id)->delete();
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
        $query = DB::table(Table::$product)->where('id', $id)->first();

        $this->editId = $id;
        $this->nameEdit = $query?->name;
        $this->priceEdit = $query?->price;
        $this->priceEdit = $query?->price;
        $this->previewImageEdit = "/storage/product-images/{$query?->image}";
        $this->oldImageName = $query?->image;
    }

    public function clearFormEdit(): void {
        $this->nameEdit = '';
        $this->priceEdit = '';
        $this->imageEdit = null;
        $this->previewImageEdit = '';
        $this->oldImageName = '';
        $this->clearErrors();
    }
    // @end edit

    // @update
    public function update(): void {
        $this->nameEdit = Set::string($this->nameEdit);

        $tbProduct = Table::$product;
        $this->validate([
            'nameEdit' => "required|string|max:20|unique:{$tbProduct},name,$this->editId,id",
            'priceEdit' => 'required|max:7',
            'imageEdit' => 'nullable|image|max:12288'
        ], [
            'nameEdit.required' => 'กรอกชื่อ',
            'nameEdit.string' => 'ห้ามใช้ตัวอักษรพิเศษ',
            'nameEdit.max' => 'ชื่อสูงสุด 20 ตัว',
            'nameEdit.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'priceEdit.required' => 'กรอกราคา',
            'priceEdit.max' => 'ราคาสูงสุด (9999.99)',
            'imageEdit.image' => 'ไฟล์ภาพเท่านั้น',
            'imageEdit.max:12288' => 'สูงสุด 12MB',
        ]);

        try {
            $image = $this->oldImageName;
            if(!empty($this->imageEdit)) {
                $image = 'prodcut'.Set::newFileName($this->imageEdit);
            }

            DB::table(Table::$product)
                ->where('id', $this->editId)
                ->update([
                    'name' => $this->nameEdit,
                    'price' => Set::number($this->priceEdit),
                    'image' => $image,
                    'updated_at' => now()
                ]);

            if(!empty($this->imageEdit)) {
                $this->imageEdit->storeAs('product-images', $image, 'public');
            }

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
        return view('livewire.product.product-index', [
            'productData' => DB::table(Table::$product)->latest()->paginate($this->paginate)
        ]);
    }
}
