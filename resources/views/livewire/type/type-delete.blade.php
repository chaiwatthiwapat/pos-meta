<div x-show="showDelete" x-init="$store.delete = $data" x-on:hidden-delete.window="showDelete = false" style="display: none" class="fixed inset-0 flex items-center justify-center bg-gray-900/50 z-[3000]">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 relative">
        <div>
            <div class="text-red-700">ต้องการลบหรือไม่</div>
        </div>

        <div class="mt-4 flex justify-end gap-1">
            <button type="button" x-on:click="showDelete = false" class="bg-blue-100 text-blue-500 hover:bg-blue-200 duration-200 px-4 py-3 h-10 w-16 rounded-lg font-medium cursor-pointer text-xs">
                ยกเลิก
            </button>

            <button type="button" x-on:click="$wire.call('delete', id)" wire:loading.attr="disabled" class="bg-red-500 text-white hover:bg-red-600 duration-200 px-4 py-3 h-10 w-16 rounded-lg font-medium cursor-pointer text-xs flex items-center justify-center">
                <span wire:loading.class="hidden">
                    ลบ
                </span>
                <div wire:loading class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
            </button>
        </div>
    </div>
</div>
