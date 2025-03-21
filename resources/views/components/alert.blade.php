<div
    x-data="{ showAlert: false }"
    x-show="showAlert"
    x-init="$store.alert = $data"
    x-on:keydown.escape.window="showAlert = false"
    style="display: none" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-[3000]">
    {{-- Stop trying to control. --}}

    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 relative">
        <div
            x-init="$store.alertMessage = $data"
            x-data="{ message: '' }"
            x-on:alert.window="message = $event.detail[0].message; showAlert = true"
            x-html="message">
        </div>

        <div class="mt-4 flex justify-end gap-1">
            <button type="button" x-on:click="showAlert = false" class="bg-blue-500 text-white hover:bg-blue-600 duration-200 px-5 py-3 rounded-lg font-medium flex items-center justify-center text-xs">
                ปิด
            </button>
        </div>
    </div>
</div>
