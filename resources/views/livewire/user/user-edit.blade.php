<div x-show="showEdit"
    x-on:hidden-edit.window="showEdit = false"
    x-on:keydown.escape.window="showEdit = false"
    style="display: none"
    class="fixed inset-0 flex items-center justify-center bg-gray-900/50 z-[2000] transition-opacity duration-300">

    <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-lg mx-4 relative">

        {{-- ปุ่มปิด Modal --}}
        <button type="button" x-on:click="showEdit = false"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-700">
            ✕
        </button>

        {{-- หัวข้อ --}}
        <h2 data-modal-header class="text-xl font-bold mb-4 text-gray-800 text-center">
            แก้ไขผู้ใช้งาน
        </h2>

        <form wire:submit="update">
            {{-- แสดง Error --}}
            @if($errors->any())
                <div class="p-3 bg-red-100 text-red-700 border border-gray-200  border-red-400 rounded-lg mb-4">
                    @foreach ($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div x-data="{ showPassword: false }">
                {{-- ชื่อผู้ใช้งาน --}}
                <div class="mb-4">
                    <label class="text-gray-600 font-medium">ชื่อ</label>
                    <input wire:model="name" type="text"
                        class="w-full px-4 py-2 border border-gray-200  rounded-lg shadow-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-300 outline-hidden">
                </div>

                {{-- รหัสผ่าน --}}
                <div class="mb-4">
                    <label class="text-gray-600 font-medium">เปลี่ยนรหัสผ่าน</label>
                    <input wire:model="password" :type="showPassword ? 'text' : 'password'"
                        class="w-full px-4 py-2 border border-gray-200  rounded-lg shadow-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-300 outline-hidden">
                </div>

                {{-- ยืนยันรหัสผ่าน --}}
                <div class="mb-4">
                    <label class="text-gray-600 font-medium">ยืนยันรหัสผ่าน</label>
                    <input wire:model="password_confirmation" :type="showPassword ? 'text' : 'password'"
                        class="w-full px-4 py-2 border border-gray-200  rounded-lg shadow-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-300 outline-hidden">
                </div>

                <div class="mb-4">
                    <input id="show-password-edit" x-on:click="showPassword = !showPassword" type="checkbox">
                    <label for="show-password-edit" class="text-gray-600 font-medium select-none cursor-pointer">ดูรหัสผ่าน</label>
                </div>
           </div>

            {{-- อัพโหลดรูป --}}
            <div x-data="{ previewImage: @entangle('previewImage') }" class="mb-4">
                <label class="text-gray-600 font-medium">ภาพผู้ใช้งาน</label>
                <input wire:model="image" type="file"
                    class="w-full px-4 py-2 border border-gray-200  rounded-lg shadow-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-300 outline-hidden"
                    x-on:change="if(file = $event.target.files[0]) previewImage = URL.createObjectURL(file)"
                    accept="image/*">

                {{-- Preview รูป --}}
                <div x-show="previewImage" class="mt-3 flex justify-center">
                    <img :src="previewImage" alt="Preview Image"
                        class="w-32 h-32 object-cover border border-gray-200  rounded-lg shadow-md">
                </div>
            </div>

            {{-- ปุ่มต่าง ๆ --}}
            <div class="flex justify-between gap-2">
                <button type="button" wire:click="clearForm"
                    class="bg-red-100 text-red-500 hover:bg-red-200 duration-200  xxx px-4 py-3 h-10 xxx  rounded-lg font-medium cursor-pointer text-xs">
                    ล้าง
                </button>

                <div class="flex gap-2">
                    <button type="button" x-on:click="showEdit = false"
                        class="bg-gray-200 text-gray-700 hover:bg-gray-300 duration-200  xxx px-4 py-3 h-10 xxx  rounded-lg font-medium cursor-pointer text-xs">
                        ปิด
                    </button>

                    <button type="submit" wire:loading.attr="disabled"
                        class="bg-blue-500 text-white hover:bg-blue-600 duration-200  xxx px-4 py-3 h-10 xxx  rounded-lg font-medium cursor-pointer text-xs flex items-center justify-center min-w-[80px]">
                        <span wire:loading.class="hidden">ตกลง</span>
                        <div wire:loading class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
