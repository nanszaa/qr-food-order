<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pesanan</title>
</head>
<body>

<h1>Riwayat Pesanan</h1>

<p>
    <a href="{{ route('kasir.orders') }}">
        Kembali ke Pesanan Aktif
    </a>
</p>

<hr>

@forelse($orders as $order)

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

    <p>
        Total :
        Rp {{ number_format(
            $order->total_price,
            0,
            ',',
            '.'
        ) }}
    </p>

    <p>
        Status Order :
        {{ $order->order_status }}
    </p>

    <p>
        Status Payment :
        {{ $order->payment->status ?? '-' }}
    </p>

    <p>
        <a href="{{ route(
            'kasir.orders.show',
            $order->order_id
        ) }}">
            Lihat Detail
        </a>
    </p>

    <hr>

@empty

    <p>
        Belum ada riwayat pesanan
    </p>

@endforelse

</body>
</html>