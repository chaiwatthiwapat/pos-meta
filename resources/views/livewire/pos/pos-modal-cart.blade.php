<div
    x-data="{
        data: JSON.parse(localStorage.getItem('cartItem')) || [],
        updateCartItem() {
            localStorage.setItem('cartItem', JSON.stringify(this.data));
        },
        get amount() {
            return this.data.reduce((sum, item) => sum + (item.amount || 0), 0);
        },
        isLg: false
    }"
    x-init="
        $store.cart = $data;
        const checkScreen = () => {
            showCart = window.matchMedia('(min-width: 1024px)').matches ? true : false;
        };
        checkScreen();
        window.addEventListener('resize', checkScreen);
    "
    x-on:clear-cart.window="
        localStorage.setItem('cartItem', null);
        $store.cart.data = JSON.parse(localStorage.getItem('cartItem')) || [];
    "
    x-show="showCart"
    class="max-w-lg w-full bg-white p-8 rounded-lg border border-gray-200  top-[50%] left-[50%] lg:top-0 lg:left-0 translate-x-[-50%] translate-y-[-50%] lg:translate-x-0 lg:translate-y-0 absolute lg:relative z-[2000]" style="display: none;">
    {{--  --}}
    <div class="w-full h-[300px] lg:h-[500px] relative overflow-auto">
        <table class="table-fixed w-full">
            <thead class="sticky top-0">
                <thead class="sticky top-0 bg-blue-100 shadow-md">
                    <tr class="hover:bg-blue-50">
                        <th class="px-1 py-3 text-blue-500 text-center text-xs font-semibold w-12">#</th>
                        <th class="px-1 py-3 text-blue-500 text-left text-xs font-semibold w-28">สินค้า</th>
                        <th class="px-1 py-3 text-blue-500 text-right text-xs font-semibold w-24 pr-4">ราคา</th>
                        <th class="px-1 py-3 text-blue-500 text-center text-xs font-semibold w-20">จำนวน</th>
                        <th class="px-1 py-3 text-blue-500 text-center text-xs font-semibold">ลบ</th>
                    </tr>
                </thead>
            </thead>

            <tbody>
                <template x-for="(item, index) in data" :key="index">
                    <tr class="hover:bg-blue-50">
                        <td class="px-1 py-3 border-b-2 border-blue-200 text-center text-xs font-semibold text-gray-700">
                            <span x-text="index + 1"></span>
                        </td>
                        <td class="px-1 py-3 border-b-2 border-blue-200 text-left text-xs font-semibold text-gray-700" x-data="{ open: false }">
                            <div class="flex gap-1 items-start">
                                <!-- แสดงชื่อหลัก -->
                                <span x-text="item.product.name.length > 20 ? item.product.name.slice(0, 20) + '...' : item.product.name" class="w-full overflow-hidden whitespace-nowrap"></span>
                                <!-- Dropdown Button -->
                                <button x-on:click="open = !open" class="text-blue-500 hover:text-blue-500 text-xs cursor-pointer">
                                    ▼
                                </button>
                            </div>

                            <!-- Dropdown Content -->
                            <div x-show="open" x-on:click.away="open = false" class="bg-white border border-gray-200  rounded-md shadow-md mt-2 min-w-40 p-2 absolute z-10">
                                <div class="text-xs text-gray-600">
                                    <p>
                                        {{-- สินค้า --}}
                                        <span class="font-semibold whitespace-nowrap">สินค้า:</span>
                                        <span x-text="item.product.name + ` (${item.product.price.toLocaleString()})`" class="text-blue-500 whitespace-nowrap"></span>
                                    </p>
                                    <p x-show="item.size.name">
                                        {{-- ไซต์ --}}
                                        <span class="font-semibold whitespace-nowrap">ไซต์:</span>
                                        <span x-text="item.size.name + ` (${item.size.price.toLocaleString()})`" class="text-blue-500 whitespace-nowrap"></span>
                                    </p>
                                    <p x-show="item.type.name">
                                        {{-- ประเภท --}}
                                        <span class="font-semibold whitespace-nowrap">ประเภท:</span>
                                        <span x-text="item.type.name + ` (${item.type.price.toLocaleString()})`" class="text-blue-500 whitespace-nowrap"></span>
                                    </p>
                                    <p x-show="item.topping.name.length">
                                        {{-- ท็อปปิ้ง --}}
                                        <span class="font-semibold whitespace-nowrap">ท็อปปิ้ง:</span>
                                        <template x-for="(name, index) in item.topping.name" :key="index">
                                            <div x-text="name + ` (${item.topping.price[index].toLocaleString()})`" class="text-blue-500 whitespace-nowrap pl-3"></div>
                                        </template>
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-1 py-3 border-b-2 border-blue-200 text-right text-xs font-semibold text-gray-700 pr-4">
                            {{-- ราคา --}}
                            <span x-text="item.amount.toLocaleString()"></span>
                        </td>
                        <td class="px-1 py-3 border-b-2 border-blue-200">
                            <div class="flex items-center justify-center text-xs font-semibold text-gray-700">

                                {{-- ลดจำนวน --}}
                                <button
                                    x-on:click="
                                        let qty = data[index].product.qty;
                                        qty > 1 ? qty-- : null;
                                        data[index].product.qty = qty;
                                        data[index].amount = qty * (data[index].product.price + data[index].optionPrice);
                                        updateCartItem();
                                    "
                                    class="px-2 py-1 bg-blue-200 text-blue-500 rounded-lg hover:bg-blue-300 duration-200 cursor-pointer">
                                    -
                                </button>

                                <div x-text="data[index].product.qty" class="w-8 text-center"></div>

                                {{-- เพิ่มจำนวน --}}
                                <button
                                    x-on:click="
                                        let qty = data[index].product.qty;
                                        qty++;
                                        data[index].product.qty = qty;
                                        data[index].amount = qty * (data[index].product.price + data[index].optionPrice);
                                        updateCartItem();
                                    "
                                    class="px-2 py-1 bg-blue-200 text-blue-500 rounded-lg hover:bg-blue-300 duration-200 cursor-pointer">
                                    +
                                </button>

                            </div>
                        </td>
                        <td class="px-1 py-3 border-b-2 border-blue-200 text-center text-xs font-semibold text-gray-700">
                            {{-- ลบ --}}
                            <button x-on:click="
                                data.splice(index, 1);
                                updateCartItem();
                            "
                            class="bg-red-500 text-white hover:bg-red-600 duration-200  xxx px-4 py-3 h-10 xxx  rounded-lg font-medium cursor-pointer text-xs">
                                ลบ
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <div class="px-1 py-3 rounded-lg border border-gray-200 text-center my-4">
        รายการ:
        <strong
            class="text-blue-500"
            x-text="data.length">
        </strong>
    </div>
    <div>
        <button
            x-on:click="showPaymentModal = true; $store.payment.amount = amount"
            type="button" wire:loading.attr="disabled"
            class="bg-blue-500 text-white hover:bg-blue-600 duration-200  xxx px-4 py-3 h-10 xxx  rounded-lg font-medium cursor-pointer text-xs w-full">
            ดำเนินการต่อ
        </button>

        <button x-on:click="showCart = false"
            class="bg-blue-100 text-blue-500 hover:bg-blue-200 duration-200  xxx px-4 py-3 h-10 xxx  rounded-lg font-medium cursor-pointer flex items-center justify-center w-full mt-4 lg:hidden">
            ปิด
        </button>
    </div>
</div>
