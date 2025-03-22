<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="h-12 flex justify-between items-center px-8 border-b">
        <img x-on:click="showSidebar = !showSidebar" class="cursor-pointer" width="24" height="24" src="{{ asset('storage/icons/menus.png') }}" alt="icon menu">
        <a href="{{ route('logout') }}" class="text-red-500">ออกจากระบบ</a>
    </div>
</div>
