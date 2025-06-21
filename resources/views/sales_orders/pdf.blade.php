<h2>Sales Order: {{ $order->order_number }}</h2>
<p>Status: {{ ucfirst($order->status) }}</p>

<table border="1" cellspacing="0" cellpadding="6" width="100%">
    <thead>
        <tr>
            <th>Product</th><th>Quantity</th><th>Price</th><th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
        </tr>
    </tbody>
</table>
