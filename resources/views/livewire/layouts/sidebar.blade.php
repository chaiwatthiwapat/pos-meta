<div class="w-64 h-[100%] bg-white shadow-md p-4">
    <nav class="space-y-2 h-[90vh] overflow-auto">
        @php
            $sidebarMenus = [];

            if(Auth::check()) {
                if(Auth::user()->role == 'admin') {
                    $sidebarMenus = [
                        ['route' => 'home.index', 'label' => 'หน้าแรก'],
                        ['route' => 'pos.index', 'label' => 'ขาย'],
                        ['route' => 'orders.index', 'label' => 'รายการขาย'],
                        ['route' => 'product.index', 'label' => 'สินค้า'],
                        ['route' => 'size.index', 'label' => 'ไซต์'],
                        ['route' => 'type.index', 'label' => 'ประเภท'],
                        ['route' => 'topping.index', 'label' => 'ท็อปปิ้ง'],
                        ['route' => 'users.index', 'label' => 'ผู้ใช้งาน'],
                    ];
                }
                else if(Auth::user()->role == 'staff') {
                    $sidebarMenus = [
                        ['route' => 'home.index', 'label' => 'หน้าแรก'],
                        ['route' => 'pos.index', 'label' => 'ขาย'],
                        ['route' => 'orders.index', 'label' => 'รายการขาย'],
                    ];
                }
            }
        @endphp

        @foreach ($sidebarMenus as $item)
            <a wire:navigate href="{{ route($item['route']) }}"
                class="flex items-center gap-3 px-4 py-3 rounded-md transition-all duration-300
                      {{ Route::is($item['route']) ? 'bg-blue-100 text-blue-600' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <span class="font-medium">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>
</div>

