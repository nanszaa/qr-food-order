<!DOCTYPE html>
<html>
<head>
    <title>Struk</title>

    <style>
        body{
            font-family: monospace;
            width:300px;
            margin:auto;
        }

        hr{
            border:none;
            border-top:1px dashed #000;
        }
    </style>
</head>
<body>

<h3 align="center">
    QR FOOD ORDER
</h3>

<hr>

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
    Rp {{ number_format(
        $item->subtotal,
        0,
        ',',
        '.'
    ) }}
</p>

@endforeach

<hr>

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
    Pembayaran :
    {{ $order->payment->method }}
</p>

<p>
    Status :
    {{ strtoupper($order->payment->status) }}
</p>

<p>
    Tanggal :
    {{ $order->created_at }}
</p>

<hr>

<p align="center">
    Terima Kasih
</p>

<script>
    window.print();
</script>

</body>
</html>