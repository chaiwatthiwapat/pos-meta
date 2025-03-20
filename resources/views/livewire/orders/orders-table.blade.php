<div>
    @php use App\Traits\Set; @endphp

    <table x-data="{ showDecimal: false }" class="table-fixed w-full">
        <thead class="sticky top-0 z-[1000]">
            <tr>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-500 text-left font-semibold w-24">
                    <div class="w-fit">
                        <button class="bg-blue-500 text-white hover:bg-blue-600 duration-200 px-5 py-3 rounded-lg font-medium flex items-center justify-center text-xs opacity-0 cursor-default">
                            hidden
                        </button>
                    </div>
                </th>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-500 text-left text-xs font-semibold w-32">
                    รหัสคำสั่งซื้อ
                </th>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-500 text-start text-xs font-semibold w-56">
                    สินค้า
                </th>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-500 text-end text-xs font-semibold w-32">
                    จำนวน
                </th>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-500 text-right text-xs font-semibold w-32">
                    <div class="flex items-center gap-1 justify-end">
                        <input x-on:change="showDecimal = !showDecimal" checked id="price-decimal" type="checkbox" class="cursor-pointer">
                        <label for="price-decimal" class="cursor-pointer select-none">ราคา</label>
                    </div>
                </th>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-500 text-center text-xs font-semibold w-52">
                    วันที่
                </th>
                <th class="px-5 py-3 border-b-2 border-blue-200 bg-blue-100 text-blue-500 text-center text-xs font-semibold">
                    {{-- actions --}}
                </th>
            </tr>
        </thead>

        <tbody>

            @foreach($ordersData as $row)
                <tr>
                    <td class="px-5 py-3 border-b-2 border-blue-200 text-center text-xs font-semibold text-gray-700">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-5 py-3 border-b-2 border-blue-200 text-start text-xs font-semibold text-gray-700">
                        {{ $row->orders_id }}
                    </td>
                    <td class="px-5 py-3 border-b-2 border-blue-200 text-left text-xs font-semibold text-gray-700" x-data="{ open: false }">
                        <div class="flex gap-1">
                            <!-- แสดงชื่อหลัก -->
                            {{ Set::textLimit($row->product_name, 50, '...') }}

                            <!-- Dropdown Button -->
                            <button x-on:click="open = !open" class="text-blue-500 hover:text-blue-500 text-xs">
                                ▼
                            </button>
                        </div>

                        <div x-show="open" x-on:click.away="open = false" class="bg-white border rounded-md shadow-md mt-2 min-w-40 p-2 absolute z-10">
                            <div class="text-xs text-gray-600">
                                <p>
                                    <span class="font-semibold whitespace-nowrap">สินค้า:</span>
                                    {{ Set::textLimit($row->product_name, 50, '...') }}<span class="text-blue-500">({{ number_format($row->product_price, 0) }})</span>
                                </p>

                                @if($row->type_name)
                                    <p>
                                        <span class="font-semibold whitespace-nowrap">ไซต์:</span>
                                        {{ Set::textLimit($row->size_name, 50, '...') }}<span class="text-blue-500">({{ number_format($row->size_price, 0) }})</span>
                                    </p>
                                @endif

                                @if($row->type_name)
                                    <p>
                                        <span class="font-semibold whitespace-nowrap">ประเภท:</span>
                                        {{ Set::textLimit($row->type_name, 50, '...') }}<span class="text-blue-500">({{ number_format($row->type_price, 0) }})</span>
                                    </p>
                                @endif
                                
                                @if($this->findOrdersTopping($row->orders_id)->count() > 0)
                                    <p>
                                        <span class="font-semibold whitespace-nowrap">ท็อปปิ้ง:</span>
                                        @foreach($this->findOrdersTopping($row->orders_id) as $tprow)
                                            <div class="pl-4">{{ $tprow->topping_name }}<span class="text-blue-500">({{ number_format($tprow->topping_price, 0) }})</span></div>
                                        @endforeach
                                    </p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-3 border-b-2 border-blue-200 text-right text-xs font-semibold text-gray-700">
                        {{ number_format($row->quantity, 0) }}
                    </td>
                    <td class="px-5 py-3 border-b-2 border-blue-200 text-right text-xs font-semibold text-gray-700">
                        <span x-show="!showDecimal">{{ number_format($row->amount, 2) }}</span>
                        <span x-show="showDecimal">{{ number_format($row->amount, 0) }}</span>
                    </td>
                    <td class="px-5 py-3 border-b-2 border-blue-200 text-center text-xs font-semibold text-gray-700">
                        {{ Set::dmyThai($row->created_at) }}
                    </td>
                    <td class="px-5 py-3 border-b-2 border-blue-200 text-center text-xs font-semibold text-gray-700">
                        <div class="flex justify-end gap-1">
                            <button class="bg-blue-500 text-white hover:bg-blue-600 duration-200 px-5 py-3 rounded-lg font-medium flex items-center justify-center">
                                พิมพ์
                            </button>
                            <button x-on:click="showDelete = true; $store.delete.id = {{ $row->id }}"
                                class="bg-red-500 text-white hover:bg-red-600 duration-200 px-5 py-3 rounded-lg font-medium flex items-center justify-center">
                                ลบ
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="mt-4">
        {{ $ordersData->links('components.paginate') }}
    </div>

</div>
