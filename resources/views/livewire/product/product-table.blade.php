<div>
    <table x-data="{ showDecimal: false }" class="w-full">
        <thead class="sticky top-0 z-[1000]">
            <tr>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-700 text-left font-semibold">
                    <button x-on:click="showInsert = true; $wire.call('clearErrors')" class="bg-blue-500 text-white hover:bg-blue-600 duration-200 px-3 py-2 rounded w-full">
                        เพิ่ม
                    </button>
                </th>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-700 text-center text-xs font-semibold w-[100px]">
                    ภาพ
                </th>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-700 text-start text-xs font-semibold w-[300px]">
                    สินค้า
                </th>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-700 text-right text-xs font-semibold w-[100px]">
                    <div class="flex items-center gap-1 justify-end">
                        <input x-on:change="showDecimal = !showDecimal" checked id="price-decimal" type="checkbox" class="cursor-pointer">
                        <label for="price-decimal" class="cursor-pointer select-none">ราคา</label>
                    </div>
                </th>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-700 text-center text-xs font-semibold">
                    {{-- actions --}}
                </th>
            </tr>
        </thead>

        <tbody>

            @foreach($productData as $row)
                <tr>
                    <td class="w-[20px] px-5 py-3 border-b-2 border-blue-200 text-center text-xs font-semibold text-gray-700">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-5 py-3 border-b-2 border-blue-200 text-left text-xs font-semibold text-gray-700 w-[100px]">
                        <div class="w-[100px] flex justify-center">
                            <img class="w-[50px] aspect-square object-cover mx-auto" src="{{ asset("storage/product-images/$row->image") }}" alt="product">
                        </div>
                    </td>
                    <td class="px-5 py-3 border-b-2 border-blue-200 text-start text-xs font-semibold text-gray-700 w-[300px]">
                        {{ $row->name }}
                    </td>
                    <td class="px-5 py-3 border-b-2 border-blue-200 text-right text-xs font-semibold text-gray-700 w-[100px]">
                        <span x-show="!showDecimal">{{ number_format($row->price, 2) }}</span>
                        <span x-show="showDecimal">{{ number_format($row->price, 0) }}</span>
                    </td>
                    <td class="px-5 py-3 border-b-2 border-blue-200 text-center text-xs font-semibold text-gray-700">
                        <div class="flex justify-end gap-1">
                            <button x-on:click="showEdit = true; $wire.call('clearErrors'); $wire.call('edit', {{ $row->id }})" class="bg-blue-200 text-blue-700 hover:bg-blue-300 duration-200 px-3 py-2 rounded">
                                แก้ไข
                            </button>
                            <button x-on:click="showDelete = true; $store.modalProductDelete.id = {{ $row->id }}"
                                class="bg-red-200 text-red-700 hover:bg-red-300 duration-200 px-3 py-2 rounded">
                                ลบ
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
