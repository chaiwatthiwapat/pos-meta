<div>
    {{-- Be like water. --}}

    <div class="w-[230px] border-r min-h-screen p-3">
        <a wire:navigate href="{{ route('home.index') }}" class="{{ Route::is('home.index') ? 'text-blue-500' : 'text-gray-500' }} block py-3 px-1 hover:text-blue-500 duration-200">
            <div class="flex gap-1 items-center">
                <div class="{{ Route::is('home.index') ?: 'opacity-0' }} w-[5px] h-[5px] bg-blue-500 rounded-[50%]"></div>
                <span>Home</span>
            </div>
        </a>

        <a wire:navigate href="{{ route('product.index') }}" class="{{ Route::is('product.index') ? 'text-blue-500' : 'text-gray-500' }} block py-3 px-1 hover:text-blue-500 duration-200">
            <div class="flex gap-1 items-center">
                <div class="{{ Route::is('product.index') ?: 'opacity-0' }} w-[5px] h-[5px] bg-blue-500 rounded-[50%]"></div>
                <span>Product</span>
            </div>
        </a>

        <a wire:navigate href="{{ route('pos.index') }}" class="{{ Route::is('pos.index') ? 'text-blue-500' : 'text-gray-500' }} block py-3 px-1 hover:text-blue-500 duration-200">
            <div class="flex gap-1 items-center">
                <div class="{{ Route::is('pos.index') ?: 'opacity-0' }} w-[5px] h-[5px] bg-blue-500 rounded-[50%]"></div>
                <span>Pos</span>
            </div>
        </a>

        <a wire:navigate href="{{ route('orders.index') }}" class="{{ Route::is('orders.index') ? 'text-blue-500' : 'text-gray-500' }} block py-3 px-1 hover:text-blue-500 duration-200">
            <div class="flex gap-1 items-center">
                <div class="{{ Route::is('orders.index') ?: 'opacity-0' }} w-[5px] h-[5px] bg-blue-500 rounded-[50%]"></div>
                <span>Orders</span>
            </div>
        </a>

    </div>
</div>
