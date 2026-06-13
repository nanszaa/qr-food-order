<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Kasir</title>
</head>

<body>

    <h1>Dashboard Kasir</h1>

    <p>
        Selamat datang,
        {{ auth()->user()->name }}
    </p>

    <hr>

    <h2>Statistik</h2>

    <p>
        Total Pesanan :
        {{ $totalOrders }}
    </p>

    <p>
        Total Menu :
        {{ $totalMenus }}
    </p>

    <p>
        Total Kategori :
        {{ $totalCategories }}
    </p>

    <p>
        Total Meja :
        {{ $totalTables }}
    </p>

    <hr>

    <h2>Pembayaran</h2>

    <p>
        Sudah Dibayar :
        {{ $paidPayments }}
    </p>

    <p>
        Pending :
        {{ $pendingPayments }}
    </p>

    <hr>

    <h2>Pendapatan</h2>

    <p>
        Rp {{ number_format(
    $todayRevenue,
    0,
    ',',
    '.'
) }}
    </p>

    <hr>

    <p>
        <a href="{{ route('kasir.orders') }}">
            Kelola Pesanan
        </a>
    </p>

    <p>
        <a href="{{ route('kasir.categories') }}">
            Kelola Kategori
        </a>
    </p>

    <p>
        <a href="{{ route('kasir.menus') }}">
            Kelola Menu
        </a>
    </p>

    <p>
        <a href="{{ route('kasir.tables') }}">
            Kelola Meja
        </a>
    </p>

    <p>
        <a href="{{ route('kasir.reports') }}">
            Laporan Penjualan
        </a>
    </p>

    <p>
        <a href="{{ route('kasir.orders.history') }}">
            Riwayat Pesanan
        </a>
    </p>

    <hr>

    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button type="submit">
            Logout
        </button>
    </form>

</body>

</html>