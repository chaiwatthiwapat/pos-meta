<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div class="flex flex-col items-center justify-center h-full text-center">
        <div class="bg-blue-100 p-8 rounded-3xl shadow-xl max-w-xl w-full">
            <p class="text-gray-600 mb-4">
                POS
            </p>
            <h1 class="text-3xl font-bold text-blue-500 mb-2">ยินดีต้อนรับสู่ระบบขายหน้าร้าน</h1>
            <p class="text-gray-600 mb-4">
                ระบบ POS ของเราออกแบบมาเพื่อให้คุณใช้งานง่าย สะดวก รวดเร็ว<br>
                จัดการสินค้า รายการขาย
            </p>
            <a wire:navigate href="{{ route('pos.index') }}"
               class="inline-block mt-4 px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                เริ่มต้นขายสินค้า
            </a>
        </div>
    </div>

</div>
