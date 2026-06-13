@extends('layouts.kasir.app')

@section('title', 'Riwayat Pesanan')

@section('page-title', 'Riwayat Pesanan')

@section('content')

<div class="flex justify-between items-center mb-6">


<div>

    <h3 class="text-lg font-semibold">
        Riwayat Pesanan
    </h3>

    <p class="text-sm text-gray-500">
        Pesanan yang sudah selesai atau dibatalkan
    </p>

</div>

<a
    href="{{ route('kasir.orders') }}"
    class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-lg"
>
    Kembali ke Pesanan Aktif
</a>


</div>

{{-- Summary --}}

<div class="grid md:grid-cols-3 gap-4 mb-8">


<div class="bg-white rounded-xl shadow-sm p-5">

    <p class="text-gray-500 text-sm">
        Total Riwayat
    </p>

    <h2 class="text-3xl font-bold mt-2">
        {{ $orders->count() }}
    </h2>

</div>

<div class="bg-white rounded-xl shadow-sm p-5">

    <p class="text-gray-500 text-sm">
        Completed
    </p>

    <h2 class="text-3xl font-bold text-green-600 mt-2">
        {{ $orders->where('order_status','completed')->count() }}
    </h2>

</div>

<div class="bg-white rounded-xl shadow-sm p-5">

    <p class="text-gray-500 text-sm">
        Cancelled
    </p>

    <h2 class="text-3xl font-bold text-red-600 mt-2">
        {{ $orders->where('order_status','cancelled')->count() }}
    </h2>

</div>


</div>

{{-- List Orders --}}

<div class="grid gap-5">

@forelse($orders as $order)


<div class="bg-white rounded-xl shadow-sm p-5">

    <div class="flex justify-between items-start">

        <div>

            <h3 class="font-bold text-lg">
                {{ $order->order_code }}
            </h3>

            <p class="text-gray-500 text-sm mt-1">
                Meja {{ $order->customerSession->table->table_number }}
            </p>

            <p class="text-gray-500 text-sm">
                {{ $order->customerSession->customer_name }}
            </p>

        </div>

        <div>

            @if($order->order_status == 'completed')

                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                    Completed
                </span>

            @elseif($order->order_status == 'cancelled')

                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                    Cancelled
                </span>

            @endif

        </div>

    </div>

    <div class="mt-4 flex justify-between items-center">

        <div>

            <p class="text-gray-500 text-sm">
                Total
            </p>

            <p class="text-xl font-bold text-green-700">
                Rp {{ number_format($order->total_price,0,',','.') }}
            </p>

        </div>

        <div>

            @if($order->payment)

                @if($order->payment->status == 'paid')

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                        Paid
                    </span>

                @else

                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                        Pending
                    </span>

                @endif

            @endif

        </div>

    </div>

    <div class="mt-5">

        <a
            href="{{ route('kasir.orders.show', $order->order_id) }}"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg"
        >
            Lihat Detail
        </a>

    </div>

</div>


@empty


<div class="bg-white rounded-xl p-10 text-center">

    <p class="text-gray-500">
        Belum ada riwayat pesanan
    </p>

</div>


@endforelse

</div>

@endsection
