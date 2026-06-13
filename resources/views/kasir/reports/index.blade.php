<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penjualan</title>
</head>

<body>

    <h1>Laporan Penjualan</h1>

    <hr>

    <h2>Ringkasan Hari Ini</h2>

    <p>
        Total Transaksi :
        {{ $todayTransactions }}
    </p>

    <p>
        Pendapatan :
        Rp {{ number_format(
    $todayRevenue,
    0,
    ',',
    '.'
) }}
    </p>

    <hr>

    <h2>Top 5 Menu Terlaris</h2>

    @forelse($bestSellingMenus as $index => $menu)

        <p>
            {{ $index + 1 }}.
            {{ $menu->menu->name }}
            ({{ $menu->total_sold }}x terjual)
        </p>

    @empty

        <p>
            Belum ada data penjualan menu
        </p>

    @endforelse

    <hr>

    <hr>

    <form method="GET">

        <p>Tanggal Awal</p>

        <input type="date" name="start_date" value="{{ request('start_date') }}">

        <p>Tanggal Akhir</p>

        <input type="date" name="end_date" value="{{ request('end_date') }}">

        <br><br>

        <button type="submit">
            Filter
        </button>

    </form>

    <hr>

    <p>
        Total Pendapatan :
        Rp {{ number_format(
    $totalRevenue,
    0,
    ',',
    '.'
) }}
    </p>

    <p>
        Total Transaksi :
        {{ $payments->count() }}
    </p>

    <hr>

    @forelse($payments as $payment)

        <p>
            Order :
            {{ $payment->order->order_code }}
        </p>

        <p>
            Metode :
            {{ $payment->method }}
        </p>

        <p>
            Nominal :
            Rp {{ number_format(
            $payment->amount,
            0,
            ',',
            '.'
        ) }}
        </p>

        <p>
            Dibayar :
            {{ $payment->paid_at }}
        </p>

        <hr>

    @empty

        <p>
            Belum ada transaksi
        </p>

    @endforelse

</body>

</html>