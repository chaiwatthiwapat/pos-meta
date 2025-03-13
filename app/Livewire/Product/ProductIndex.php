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

    public ?UploadedFile $productImage = null;
    public ?string $previewImage = '';
    public string $productName = '';
    public string $productPrice = '';
    public int $paginate = 10;
    public bool $priceDecimal = false;

    public ?int $editId = null;
    public ?UploadedFile $productImageEdit = null;
    public ?string $previewImageEdit = '';
    public ?string $oldProductImageName = '';
    public ?string $productNameEdit = '';
    public ?string $productPriceEdit = '';

    // @insert
    public function insert(): void {
        $this->productName = Set::string($this->productName);

        $tbProduct = Table::$product;
        $this->validate([
            'productName' => "required|string|max:20|unique:{$tbProduct},name",
            'productPrice' => 'required|max:7',
            'productImage' => 'required|image|max:12288'
        ], [
            'productName.required' => 'กรอกชื่อ',
            'productName.string' => 'ห้ามใช้ตัวอักษรพิเศษ',
            'productName.max' => 'ชื่อสูงสุด 20 ตัว',
            'productName.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'productPrice.required' => 'กรอกราคา',
            'productPrice.max' => 'ราคาสูงสุด (9999.99)',
            'productImage.required' => 'เพิ่มภาพ',
            'productImage.image' => 'ไฟล์ภาพเท่านั้น',
            'productImage.max:12288' => 'สูงสุด 12MB',
        ]);

        try {
            $productImageName = 'product'.Set::newFileName($this->productImage);

            DB::table(Table::$product)
                ->insert([
                    'name' => $this->productName,
                    'price' => Set::number($this->productPrice),
                    'image' => $productImageName,
                    'created_at' => now()
                ]);

            $this->productImage->storeAs('product-images', $productImageName, 'public');

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
        $this->productNameEdit = $query?->name;
        $this->productPriceEdit = $query?->price;
        $this->productPriceEdit = $query?->price;
        $this->previewImageEdit = "/storage/product-images/{$query?->image}";
        $this->oldProductImageName = $query?->image;
    }

    public function clearFormEdit(): void {
        $this->productNameEdit = '';
        $this->productPriceEdit = '';
        $this->productImageEdit = null;
        $this->previewImageEdit = '';
        $this->oldProductImageName = '';
        $this->clearErrors();
    }
    // @end edit

    // @update
    public function update(): void {
        $this->productNameEdit = Set::string($this->productNameEdit);

        $tbProduct = Table::$product;
        $this->validate([
            'productNameEdit' => "required|string|max:20|unique:{$tbProduct},name,$this->editId,id",
            'productPriceEdit' => 'required|max:7',
            'productImageEdit' => 'nullable|image|max:12288'
        ], [
            'productNameEdit.required' => 'กรอกชื่อ',
            'productNameEdit.string' => 'ห้ามใช้ตัวอักษรพิเศษ',
            'productNameEdit.max' => 'ชื่อสูงสุด 20 ตัว',
            'productNameEdit.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'productPriceEdit.required' => 'กรอกราคา',
            'productPriceEdit.max' => 'ราคาสูงสุด (9999.99)',
            'productImageEdit.image' => 'ไฟล์ภาพเท่านั้น',
            'productImageEdit.max:12288' => 'สูงสุด 12MB',
        ]);

        try {
            $productImage = $this->oldProductImageName;
            if(!empty($this->productImageEdit)) {
                $productImage = 'prodcut'.Set::newFileName($this->productImageEdit);
            }

            DB::table(Table::$product)
                ->where('id', $this->editId)
                ->update([
                    'name' => $this->productNameEdit,
                    'price' => Set::number($this->productPriceEdit),
                    'image' => $productImage,
                    'updated_at' => now()
                ]);

            if(!empty($this->productImageEdit)) {
                $this->productImageEdit->storeAs('product-images', $productImage, 'public');
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
