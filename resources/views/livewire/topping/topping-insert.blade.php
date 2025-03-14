<div x-show="showInsert"
    x-on:hidden-insert.window="showInsert = false"
    style="display: none"
    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-[2000] transition-opacity duration-300">

    {{--  --}}
    <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-lg relative">

        {{-- ปุ่มปิด --}}
        <button type="button" x-on:click="showInsert = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700">
            ✕
        </button>

        {{-- หัวข้อ --}}
        <h2 data-modal-header class="text-xl font-bold mb-4 text-gray-800 text-center">
            เพิ่ม
        </h2>

        <form wire:submit="insert">
            {{-- แสดง Error --}}
            @if($errors->any())
                <div class="p-3 bg-red-100 text-red-700 border border-red-400 rounded mb-4">
                    @foreach ($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {{-- ชื่อ --}}
            <div class="mb-4">
                <label class="text-gray-600 font-medium">ชื่อ</label>
                <input wire:model="name" type="text"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:border-blue-300 outline-none">
            </div>

            {{-- ราคา --}}
            <div class="mb-4">
                <label class="text-gray-600 font-medium">ราคา</label>
                <input wire:model="price" type="number"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:border-blue-300 outline-none spin-none">
            </div>

            {{-- ปุ่มต่าง ๆ --}}
            <div class="flex justify-between gap-2">
                <button type="button" wire:click="clearFormInsert"
                    class="bg-red-100 text-red-500 hover:bg-red-200 duration-200 px-4 py-2 rounded-lg font-medium">
                    ล้าง
                </button>

                <div class="flex gap-2">
                    <button type="button" x-on:click="showInsert = false"
                        class="bg-gray-200 text-gray-700 hover:bg-gray-300 duration-200 px-4 py-2 rounded-lg font-medium">
                        ปิด
                    </button>

                    <button type="submit" wire:loading.attr="disabled"
                        class="bg-blue-500 text-white hover:bg-blue-600 duration-200 px-5 py-2 rounded-lg font-medium flex items-center justify-center min-w-[80px]">
                        <span wire:loading.class="hidden">ตกลง</span>
                        <div wire:loading class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
