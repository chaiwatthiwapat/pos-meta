<div class="flex-grow bg-white p-3 rounded border">
    <div x-data="{
        data: JSON.parse(localStorage.getItem('cartItem')) || [],
        updateLocalStorage() {
            localStorage.setItem('cartItem', JSON.stringify(this.data));
        },
    }" x-init="$store.cart = $data" class="h-[500px] overflow-auto">

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
                        <td class="px-5 py-3 border-b-2 border-blue-200 text-left text-xs font-semibold text-gray-700">
                            <span x-text="item.name"></span>
                        </td>
                        <td class="px-5 py-3 border-b-2 border-blue-200 text-right text-xs font-semibold text-gray-700">
                            <span x-text="item.price"></span>
                        </td>
                        <td class="px-5 py-3 border-b-2 border-blue-200">
                            <div class="flex items-center justify-center text-xs font-semibold text-gray-700">

                                {{-- ลดจำนวน --}}
                                <button
                                    x-on:click="
                                        data[index].qty > 1 ? data[index].qty-- : null;
                                        updateLocalStorage();
                                    "
                                    class="px-2 py-1 bg-blue-200 text-blue-700 rounded hover:bg-blue-300 duration-200">
                                    -
                                </button>

                                <div x-text="data[index].qty" class="w-[30px] text-center"></div>

                                {{-- เพิ่มจำนวน --}}
                                <button
                                    x-on:click="
                                        data[index].qty++;
                                        updateLocalStorage();
                                    "
                                    class="px-2 py-1 bg-blue-200 text-blue-700 rounded hover:bg-blue-300 duration-200">
                                    +
                                </button>

                            </div>
                        </td>
                        <td class="px-5 py-3 border-b-2 border-blue-200 text-center text-xs font-semibold text-gray-700 w-[100px]">
                            <button x-on:click="
                                data.splice(index, 1);
                                updateLocalStorage();
                            "
                            class="bg-red-200 text-red-700 hover:bg-red-300 duration-200 px-3 py-2 rounded">
                                ลบ
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>


        </table>
    </div>

    <div class="p-2 border border-blue-200 text-center my-4">
        รายการ: <strong class="text-blue-500">12</strong>
    </div>
    <div>
        <button class="bg-blue-500 text-white hover:bg-blue-400 duration-200 px-3 py-2 rounded w-full">
            ดำเนินการต่อ
        </button>
    </div>
</div>
