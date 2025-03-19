<?php

namespace App\Livewire\User;

use App\Traits\Set;
use App\Traits\Table;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserIndex extends Component
{
    use WithFileUploads;
    use Set;
    use Table;

    public int $paginate = 10;

    // @model
    public ?int $id = null;
    public ?UploadedFile $image = null;
    public ?string $previewImage = '';
    public string $name = '';
    public string $password = '';
    public string $password_confirmation = '';

    // @insert
    public function insert(): void {
        $this->name = Set::string($this->name);

        $tbUser = Table::$users;
        $this->validate([
            'name' => "required|string|max:20|unique:{$tbUser},name",
            'password' => 'required|string|min:6|max:16|confirmed',
            'image' => 'nullable|image|max:12288'
        ], [
            'name.required' => 'กรอกชื่อ',
            'name.string' => 'ห้ามใช้ตัวอักษรพิเศษ',
            'name.max' => 'ชื่อสูงสุด 20 ตัว',
            'name.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'password.required' => 'กรอกรหัสผ่าน',
            'password.min' => 'อย่างน้อย 6',
            'password.max' => 'มากสุด 16',
            'password.confirmed' => 'รหัสผ่านไม่ตรงกัน',
            'image.image' => 'ไฟล์ภาพเท่านั้น',
            'image.max' => 'สูงสุด 12MB',
        ]);

        try {
            $imageName = null;
            if($this->image) {
                $imageName = 'user'.Set::newFileName($this->image);
            }

            DB::table(Table::$users)
                ->insert([
                    'name' => Set::string($this->name),
                    'password' => Hash::make($this->password),
                    'image' => $imageName,
                    'created_at' => now()
                ]);

            if($this->image) {
                $this->image->storeAs('user-images', $imageName, 'public');
            }

            $this->dispatch('alert', ['message' => '<div class="text-green-700">เพิ่มสำเร็จ</div>']);
            $this->clearForm();
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

    public function clearForm(): void {
        $this->name = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->image = null;
        $this->previewImage = '';
        $this->clearErrors();
    }
    // @end insert

    // @delete
    public function delete(?int $id = null): void {
        DB::beginTransaction();

        try {
            DB::table(Table::$users)->where('id', $id)->delete();
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
        $query = DB::table(Table::$users)->where('id', $id)->first();

        $oldImage = $query?->image ?? 'default.png';
        $this->id = $id;
        $this->name = $query?->name;
        $this->previewImage = "/storage/user-images/{$oldImage}";
        $this->password = '';
        $this->password_confirmation = '';
    }
    // @end edit

    // @update
    public function update(): void {
        $this->name = Set::string($this->name);

        $tbUser = Table::$users;
        $this->validate([
            'name' => "required|string|max:20|unique:{$tbUser},name,$this->id,id",
            'password' => 'nullable|string|min:6|max:16|confirmed',
            'image' => 'nullable|image|max:12288'
        ], [
            'name.required' => 'กรอกชื่อ',
            'name.string' => 'ห้ามใช้ตัวอักษรพิเศษ',
            'name.max' => 'ชื่อสูงสุด 20 ตัว',
            'name.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'password.min' => 'อย่างน้อย 6',
            'password.max' => 'มากสุด 16',
            'password.confirmed' => 'รหัสผ่านไม่ตรงกัน',
            'image.image' => 'ไฟล์ภาพเท่านั้น',
            'image.max' => 'สูงสุด 12MB',
        ]);

        DB::beginTransaction();

        try {
            $update = [
                'name' => Set::string($this->name),
                'updated_at' => now()
            ];

            if($this->password) {
                $update = array_merge($update, ['password' => Hash::make($this->password)]);
            }

            if($this->image) {
                $image = 'user'.Set::newFileName($this->image);
                $update = array_merge($update, ['image' => $image]);
            }

            DB::table(Table::$users)->where('id', $this->id)->update($update);

            if($this->image) {
                $this->image->storeAs('user-images', $image, 'public');
            }

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
        return view('livewire.user.user-index', [
            'userData' => DB::table(Table::$users)->latest()->paginate($this->paginate)
        ]);
    }
}
