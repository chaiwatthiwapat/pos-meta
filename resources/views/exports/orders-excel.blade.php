@php
    use App\Traits\Table;
@endphp

<table>
    <thead>
        <tr>
            <th>รหัสคำสั่งซื้อ</th>
            <th>พนักงานขาย</th>
            <th>product_name</th>
            <th>product_price</th>
            <th>size_name</th>

            <th>size_price</th>
            <th>type_name</th>
            <th>type_price</th>
            <th>topping_name</th>
            <th>topping_price</th>

            <th>quantity</th>
            <th>amount</th>
            <th>รับเงิน</th>
            <th>ทอนเงิน</th>
            <th>วันที่คำสั่งซื้อ</th>
        </tr>
    </thead>

    <tbody>

        @foreach($data['orders'] as $orders_id => $collect)
            @foreach($collect as $index => $row)
                <tr>
                    <td>{{ $index == 0 ? $row->orders_id : null }}</td>
                    <td>{{ $row->sale_name }}</td>
                    <td>{{ $row->product_name }}</td>
                    <td>{{ $row->product_price }}</td>
                    <td>{{ $row->size_name }}</td>

                    <td>{{ $row->size_price }}</td>
                    <td>{{ $row->type_name }}</td>
                    <td>{{ $row->type_price }}</td>

                    <td>
                        @php
                            $toppings = $data['toppingsGrouped'][$row->orders_detail_id] ?? collect();
                            $toppingList = $toppings
                                ->map(fn($t) => "{$t->topping_name} ({$t->topping_price})")
                                ->implode(', ');
                        @endphp
                        {{ $toppingList }}
                    </td>
                    
                    <td>
                        @php
                            $tprice = $toppings->sum('topping_price');
                        @endphp
                        {{ number_format($tprice, 2) }}
                    </td>

                    <td>{{ $row->quantity }}</td>
                    <td>{{ $row->amount }}</td>
                    <td>{{ $row->get_money }}</td>
                    <td>{{ $row->change_money }}</td>
                    <td>{{ $row->created_at }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
