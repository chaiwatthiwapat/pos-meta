<div
    x-data="{
        data: JSON.parse(localStorage.getItem('cartItem')) || [],
        updateCartItem() {
            localStorage.setItem('cartItem', JSON.stringify(this.data));
        },
        get amount() {
            return this.data.reduce((sum, item) => sum + (item.amount || 0), 0);
        }
    }"
    x-init="$store.cart = $data"
    class="flex-grow bg-white p-3 rounded border">
    {{--  --}}
    <div class="h-[500px] w-[500px] overflow-auto">
        <table class="w-full">
            <thead class="sticky top-0">
                <thead class="sticky top-0 bg-blue-100 shadow-md">
                    <tr>
                        <th class="px-5 py-3 text-blue-700 text-left text-xs font-semibold">#</th>
                        <th class="px-5 py-3 text-blue-700 text-left text-xs font-semibold">สินค้า</th>
                        <th class="px-5 py-3 text-blue-700 text-right text-xs font-semibold">ราคา</th>
                        <th class="px-5 py-3 text-blue-700 text-center text-xs font-semibold">จำนวน</th>
                        <th class="px-5 py-3 text-blue-700 text-center text-xs font-semibold w-[100px]">ลบ</th>
                    </tr>
                </thead>
            </thead>

            <tbody>
                <template x-for="(item, index) in data" :key="index">
                    <tr>
                        <td class="w-[20px] px-5 py-3 border-b-2 border-blue-200 text-center text-xs font-semibold text-gray-700">
                            <span x-text="index + 1"></span>
                        </td>
                        <td class="px-5 py-3 border-b-2 border-blue-200 text-left text-xs font-semibold text-gray-700" x-data="{ open: false }">
                            <div class="flex gap-1">
                                <!-- แสดงชื่อหลัก -->
                                <div class="font-bold text-sm text-gray-900" x-text="item.product.name"></div>
                            
                                <!-- Dropdown Button -->
                                <button x-on:click="open = !open" class="text-blue-500 hover:text-blue-700 text-xs">
                                    ▼
                                </button>
                            </div>
                        
                            <!-- Dropdown Content -->
                            <div x-show="open" x-on:click.away="open = false" class="bg-white border rounded-md shadow-md mt-2 min-w-40 p-2 absolute z-10">
                                <div class="text-xs text-gray-600">
                                    <p>
                                        <span class="font-semibold whitespace-nowrap">สินค้า:</span> 
                                        <span x-text="item.product.name + ` (${item.product.price})`" class="text-blue-500 whitespace-nowrap"></span>
                                    </p>
                                    <p x-show="item.size.name">
                                        <span class="font-semibold whitespace-nowrap">ไซต์:</span> 
                                        <span x-text="item.size.name + ` (${item.size.price})`" class="text-blue-500 whitespace-nowrap"></span>
                                    </p>
                                    <p x-show="item.type.name">
                                        <span class="font-semibold whitespace-nowrap">ประเภท:</span> 
                                        <span x-text="item.type.name + ` (${item.type.price})`" class="text-blue-500 whitespace-nowrap"></span>
                                    </p>
                                    <p x-show="item.topping.name.length">
                                        <span class="font-semibold whitespace-nowrap">ท็อปปิ้ง:</span> 
                                        <template x-for="(name, index) in item.topping.name" :key="index">
                                            <div x-text="name + ` (${item.topping.price[index]})`" class="text-blue-500 whitespace-nowrap pl-3"></div>
                                        </template>
                                    </p>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-5 py-3 border-b-2 border-blue-200 text-right text-xs font-semibold text-gray-700">
                            <span x-text="item.amount"></span>
                        </td>
                        <td class="px-5 py-3 border-b-2 border-blue-200">
                            <div class="flex items-center justify-center text-xs font-semibold text-gray-700">

                                {{-- ลดจำนวน --}}
                                <button
                                    x-on:click="
                                        let qty = data[index].product.qty;
                                        qty > 1 ? qty-- : null;
                                        data[index].product.qty = qty;
                                        data[index].amount = qty * (data[index].product.price + data[index].options);
                                        updateCartItem();
                                    "
                                    class="px-2 py-1 bg-blue-200 text-blue-700 rounded hover:bg-blue-300 duration-200">
                                    -
                                </button>

                                <div x-text="data[index].product.qty" class="w-8 text-center"></div>

                                {{-- เพิ่มจำนวน --}}
                                <button
                                    x-on:click="
                                        let qty = data[index].product.qty;
                                        qty++;
                                        data[index].product.qty = qty;
                                        data[index].amount = qty * (data[index].product.price + data[index].options);
                                        updateCartItem();
                                    "
                                    class="px-2 py-1 bg-blue-200 text-blue-700 rounded hover:bg-blue-300 duration-200">
                                    +
                                </button>

                            </div>
                        </td>
                        <td class="px-5 py-3 border-b-2 border-blue-200 text-center text-xs font-semibold text-gray-700 w-[100px]">
                            <button x-on:click="
                                data.splice(index, 1);
                                updateCartItem();
                            "
                            class="bg-red-500 text-white hover:bg-red-600 duration-200 px-3 py-2 rounded-lg font-medium flex items-center justify-center mx-auto">
                                ลบ
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <div class="px-5 py-3 rounded-lg border border-blue-200 text-center my-4">
        รายการ:
        <strong
            class="text-blue-500"
            x-text="amount">
        </strong>
    </div>
    <div>
        <button class="bg-blue-600 text-white hover:bg-blue-500 transition duration-200 px-4 py-3 rounded-lg w-full font-semibold shadow-md">
            ดำเนินการต่อ
        </button>
    </div>
</div>
