<div class="w-[260px] min-h-screen bg-white shadow-md p-4">
    <nav class="space-y-2">
        @php
            $navItems = [
                ['route' => 'home.index', 'label' => 'Home'],
                ['route' => 'product.index', 'label' => 'Product'],
                ['route' => 'size.index', 'label' => 'Size'],
                ['route' => 'type.index', 'label' => 'Type'],
                ['route' => 'topping.index', 'label' => 'Topping'],
                ['route' => 'pos.index', 'label' => 'POS'],
                ['route' => 'orders.index', 'label' => 'Orders'],
            ];
        @endphp

        @foreach ($navItems as $item)
            <a wire:navigate href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-4 py-3 rounded-md transition-all duration-300
                      {{ Route::is($item['route']) ? 'bg-blue-100 text-blue-600' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <span class="font-medium">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>
</div>

