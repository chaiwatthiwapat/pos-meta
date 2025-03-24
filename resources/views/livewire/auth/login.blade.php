<div x-data="{ name: @entangle('name'), password: @entangle('password') }" class="min-h-[50vh] flex items-center justify-center">
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="w-full max-w-lg mx-4 relative p-8 rounded-lg border">
        <form wire:submit="login">
            <p class="text-gray-600 mb-4 text-center text-2xl">
                เข้าสู่ระบบ POS
            </p>

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
                    <input x-model="name" type="text"
                        class="w-full px-4 py-2 border border-gray-200  rounded-lg shadow-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-300 outline-hidden">
                </div>

                {{-- รหัสผ่าน --}}
                <div class="mb-4">
                    <label class="text-gray-600 font-medium">รหัสผ่าน</label>
                    <input x-model="password" :type="showPassword ? 'text' : 'password'"
                        class="w-full px-4 py-2 border border-gray-200  rounded-lg shadow-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-300 outline-hidden">
                </div>

                <div class="mb-4">
                    <input id="show-password" x-on:click="showPassword = !showPassword" type="checkbox">
                    <label for="show-password" class="text-gray-600 font-medium select-none cursor-pointer">ดูรหัสผ่าน</label>
                </div>
           </div>

           <div class="flex gap-3">
                <button type="button" x-on:click="name = 'admin'; password = 'password';" class="px-3 py-2 rounded-lg text-center flex items-center justify-center gap-1 text-blue-500 bg-blue-100">
                    😎 Admin
                </button>
                <button type="button" x-on:click="name = 'staff'; password = 'password';" class="px-3 py-2 rounded-lg text-center flex items-center justify-center gap-1 text-green-500 bg-green-100">
                    😎 Staff
                </button>
           </div>

            {{-- ปุ่มต่าง ๆ --}}
            <div class="flex justify-end">
                <button type="submit" wire:loading.attr="disabled"
                    class="bg-blue-500 text-white hover:bg-blue-600 duration-200 px-4 py-2 rounded-lg font-medium cursor-pointer flex items-center justify-center min-w-[80px] h-10">
                    <span wire:loading.class="hidden">ตกลง</span>
                    <div wire:loading class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                </button>
            </div>
        </form>
    </div>
</div>
