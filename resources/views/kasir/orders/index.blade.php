<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pesanan</title>
</head>
<body>

<h1>Daftar Pesanan</h1>
    <hr>

    <h3>Ringkasan Pesanan</h3>
    <hr>

        <h3>Filter Pesanan</h3>

        <a href="{{ route('kasir.orders') }}">
            Semua
        </a>

        |

        <a href="{{ route('kasir.orders', ['status' => 'pending']) }}">
            Pending
        </a>

        |

        <a href="{{ route('kasir.orders', ['status' => 'processing']) }}">
            Processing
        </a>

        |

        <a href="{{ route('kasir.orders', ['status' => 'completed']) }}">
            Completed
        </a>

        |

        <a href="{{ route('kasir.orders', ['status' => 'cancelled']) }}">
            Cancelled
        </a>

    <hr>

    <p>
        Pending :
        {{ $pendingCount }}
    </p>

    <p>
        Processing :
        {{ $processingCount }}
    </p>

    <p>
        Completed :
        {{ $completedCount }}
    </p>

    <p>
        Cancelled :
        {{ $cancelledCount }}
    </p>

    <hr>

@forelse($orders as $order)

    <hr>

    <p>
        Order :
        <a href="{{ route('kasir.orders.show', $order->order_id) }}">
         {{ $order->order_code }}
</a>
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
        Rp {{ number_format($order->total_price,0,',','.') }}
    </p>

   <p>
    Status Order :

    @if($order->order_status == 'pending')
        <span style="color:red;">
            Pending
        </span>

    @elseif($order->order_status == 'processing')
        <span style="color:orange;">
            Processing
        </span>

    @elseif($order->order_status == 'completed')
        <span style="color:green;">
            Completed
        </span>

    @elseif($order->order_status == 'cancelled')
        <span style="color:red;">
            Cancelled
        </span>

    @endif

</p>
    <p>
    Status Payment :

    @if($order->payment->status == 'pending')
        <span style="color:red;">
            Pending
        </span>

    @elseif($order->payment->status == 'paid')
        <span style="color:green;">
            Paid
        </span>

    @endif

</p>

@empty

    <p>
        Belum ada pesanan
    </p>

@endforelse

</body>
</html>