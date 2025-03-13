<div x-show="showInsert" x-on:hidden-insert.window="showInsert = false" style="display: none" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-[2000]">
    <div class="bg-white p-6 rounded-lg shadow-lg w-[600px]">
        <h2 data-modal-header class="text-xl font-bold mb-4">
            เพิ่ม
        </h2>

        <form wire:submit="insert">
            <div>
                @if($errors->any())
                    <div class="p-3 bg-red-100 text-red-700 border border-red-400 rounded">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-4">
                    <div class="text-gray-600">
                        สินค้า
                    </div>
                    <input wire:model="productName" type="text" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-200 outline-none">
                </div>

                <div class="mt-4">
                    <div class="text-gray-600">
                        ราคา
                    </div>
                    <input wire:model="productPrice" type="number" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-200 outline-none spin-none">
                </div>

                <div x-data="{ previewImage: @entangle('previewImage') }" class="mt-4">
                    <div class="text-gray-600">ภาพ</div>
                    <input wire:model="productImage" type="file" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-200 outline-none"
                        x-on:change="if(file = $event.target.files[0]) previewImage = URL.createObjectURL(file)" accept="image/*">

                    <div x-show="previewImage" class="bg-gray-100 p-3">
                        <img :src="previewImage" alt="Preview Image" class="w-40 h-40 object-cover border rounded">
                    </div>
                </div>
            </div>

            <div class="mt-4 flex justify-between gap-1">
                <button type="button" wire:click="clearFormSave" class="bg-red-100 text-red-500 hover:bg-red-200 duration-200 px-3 py-2 rounded">
                    ล้าง
                </button>

                <div class="flex gap-1">
                    <button type="button" x-on:click="showInsert = false" class="bg-blue-200 text-blue-500 hover:bg-blue-100 duration-200 px-3 py-2 rounded">
                        ปิด
                    </button>
                    <button type="submit" wire:loading.attr="disabled" class="bg-blue-500 text-white hover:bg-blue-600 duration-200 px-3 w-[70px] rounded flex items-center justify-center">
                        <span wire:loading.class="hidden">
                            ตกลง
                        </span>
                        <div wire:loading class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
