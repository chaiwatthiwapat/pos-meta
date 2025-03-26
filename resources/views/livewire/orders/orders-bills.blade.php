<div x-data="{ showBills: false }" x-show="showBills" x-init="$store.bills = $data" style="display: none" class="fixed inset-0 flex items-center print:items-start justify-center bg-gray-900/50 z-[3000]">
    {{-- Stop trying to control. --}}

    <div class="bg-white p-6 rounded-lg shadow-lg print:shadow-none w-full max-w-lg mx-4 relative">
        <div>
            <div class="text-center">
                <strong>บิล</strong>
            </div>

            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left">รหัสคำสั่งซื้อ</th>
                        <th class="text-right">{{ $this->ordersBills()?->orders_id }}</th>
                    </tr>

                    <tr>
                        <th colspan="2">
                            <div class="border-b mt-2"></div>
                            <div class="mb-2"></div>
                        </th>
                    </tr>

                    <tr>
                        <th class="text-left">รายการ</th>
                        <th class="text-right">ราคา</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($this->ordersDetailBills() as $row)
                        <tr>
                            <td class="text-left">{{ $row->product_name }} ({{ number_format($row->quantity, 0) }} x {{ $row->product_price }})</td>
                            <td class="text-right">{{ number_format($row->product_price * $row->quantity, 2) }}</td>
                        </tr>

                        <tr>
                            <td class="text-left pl-5">ไซต์: {{ $row->size_name }} ({{ number_format($row->quantity, 0) }} x {{ $row->size_price }})</td>
                            <td class="text-right">{{ number_format($row->size_price * $row->quantity, 2) }}</td>
                        </tr>

                        <tr>
                            <td class="text-left pl-5">ประเภท: {{ $row->type_name }} ({{ number_format($row->quantity, 0) }} x {{ $row->type_price }})</td>
                            <td class="text-right">{{ number_format($row->type_price * $row->quantity, 2) }}</td>
                        </tr>

                        @php
                            $toppings = \DB::table(App\Traits\Table::$ordersTopping)->where('orders_detail_id', $row->orders_detail_id)->get();
                        @endphp

                        @foreach($toppings as $trow)
                            <tr>
                                <td class="text-left pl-5">ประเภท: {{ $trow->topping_name }} ({{ number_format($row->quantity, 0) }} x {{ $trow->topping_price }})</td>
                                <td class="text-right">{{ number_format($trow->topping_price * $row->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    @endforeach

                    <tr>
                        <td colspan="2">
                            <div class="border-t"></div>
                            <div class="flex justify-between border-b-4 border-double">
                                <div>รวม</div>
                                <div>{{ number_format($this->ordersBills()?->total_amount ?? 0, 2) }}</div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="mt-4 flex justify-end gap-1 print:hidden">
            <button type="button" x-on:click="showBills = false" class="bg-blue-100 text-blue-500 hover:bg-blue-200 duration-200 px-4 py-3 h-10 w-16 rounded-lg font-medium cursor-pointer text-xs">
                ปิด
            </button>
            <button type="button" onclick="window.print()" class="bg-blue-500 text-white hover:bg-blue-600 duration-200 px-4 py-3 h-10 w-16 rounded-lg font-medium cursor-pointer text-xs">
                พิมพ์
            </button>
        </div>
    </div>
</div>
