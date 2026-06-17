<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
        }

        .summary {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <h1>Laporan Penjualan</h1>

    <p>
        Dicetak :
        {{ now()->format('d-m-Y H:i') }}
    </p>

    <div class="summary">

        <h3>Total Pendapatan</h3>

        <p>
            Rp {{ number_format($totalRevenue,0,',','.') }}
        </p>

        <h3>Top 5 Menu Terlaris</h3>

        <ol>

            @foreach($bestSellingMenus as $menu)

                <li>
                    {{ $menu->menu->name }}
                    ({{ $menu->total_sold }}x)
                </li>

            @endforeach

        </ol>

    </div>

    <h3>Daftar Transaksi</h3>

    <table>

        <thead>

            <tr>
                <th>Order</th>
                <th>Metode</th>
                <th>Nominal</th>
                <th>Tanggal</th>
            </tr>

        </thead>

        <tbody>

            @foreach($payments as $payment)

                <tr>

                    <td>
                        {{ $payment->order->order_code }}
                    </td>

                    <td>
                        {{ $payment->method }}
                    </td>

                    <td>
                        Rp {{ number_format(
                            $payment->amount,
                            0,
                            ',',
                            '.'
                        ) }}
                    </td>

                    <td>
                        {{ $payment->paid_at }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</body>

</html>