<!DOCTYPE html>
<html>
<head>
    <title>Detail Pesanan</title>
</head>
<body>

<h1>Detail Pesanan</h1>

<p>
    Order :
    {{ $order->order_code }}
</p>

<p>
    Meja :
    {{ $order->customerSession->table->table_number }}
</p>

<p>
    Pelanggan :
    {{ $order->customerSession->customer_name }}
</p>

<hr>

@foreach($order->orderItems as $item)

    <p>
        {{ $item->menu->name }}
        x
        {{ $item->quantity }}
    </p>

    <p>
        Rp {{ number_format($item->subtotal,0,',','.') }}
    </p>

    <br>

@endforeach

<hr>

<p>
    Total :
    Rp {{ number_format($order->total_price,0,',','.') }}
</p>

<p>
    Status Order :
    {{ $order->order_status }}

    @if(session('success'))

    <p>
        {{ session('success') }}
    </p>

            @endif

            <form
                action="{{ route(
                    'kasir.orders.update-status',
                    $order->order_id
                ) }}"
                method="POST"
            >

                @csrf

                <select name="order_status">

                    <option value="pending">
                        Pending
                    </option>

                    <option value="processing">
                        Processing
                    </option>

                    <option value="completed">
                        Completed
                    </option>

                    <option value="cancelled">
                        Cancelled
                    </option>

                </select>

                <button type="submit">
                    Update Status
                </button>

            </form>
</p>

<p>
    Status Payment :
    {{ $order->payment->status }}
</p>
@if($order->payment->paid_at)

<p>
    Dibayar Pada :
    {{ \Carbon\Carbon::parse($order->payment->paid_at)->format('d-m-Y H:i') }}
</p>

@endif
<p>
    Metode :
    {{ $order->payment->method }}
</p>

@if(
    $order->payment->method === 'cash'
    &&
    $order->payment->status === 'pending'
)

    <form
        action="{{ route(
            'kasir.payment.confirm',
            $order->payment->payment_id
        ) }}"
        method="POST"
    >
        @csrf

        <button type="submit">
            Konfirmasi Pembayaran
        </button>

    </form>

@endif
</body>
</html>