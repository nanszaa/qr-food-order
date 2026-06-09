@extends('layouts.customer.customer')

@section('title', 'Pesanan Berhasil')

@section('content')

<div class="p-4">

    <!-- Success Header -->

    <div class="text-center mb-6">

        <div class="text-6xl mb-3">
            🎉
        </div>

        <h1 class="text-2xl font-bold text-green-600">
            Pesanan Berhasil
        </h1>

        <p class="text-gray-500 mt-2">
            Pesanan sedang diproses oleh sistem
        </p>

    </div>

    <!-- Informasi Pesanan -->

    <div class="bg-white rounded-2xl shadow-lg p-4 mb-4">

        <h2 class="font-bold text-lg mb-4">
            Informasi Pesanan
        </h2>

        <div class="space-y-2 text-sm">

            <div class="flex justify-between">
                <span>No Pesanan</span>
                <span class="font-semibold">
                    {{ $order->order_code }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Nama Pelanggan</span>
                <span class="font-semibold">
                    {{ $order->customerSession->customer_name ?? 'Guest' }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Meja</span>
                <span class="font-semibold">
                    {{ $order->customerSession->table->table_number ?? '-' }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Status Pesanan</span>
                <span class="text-orange-500 font-semibold">
                    {{ ucfirst($order->order_status) }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Metode Pembayaran</span>
                <span class="font-semibold">
                    {{ strtoupper($order->payment->method) }}
                </span>
            </div>

        </div>

    </div>

    <!-- Detail Menu -->

    <div class="bg-white rounded-2xl shadow-lg p-4 mb-4">

        <h2 class="font-bold text-lg mb-4">
            Detail Pesanan
        </h2>

        @foreach($order->orderItems as $item)

            <div class="flex justify-between mb-3">

                <div>
                    <p class="font-medium">
                        {{ $item->menu->name }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ $item->quantity }} x
                        Rp {{ number_format($item->price,0,',','.') }}
                    </p>
                </div>

                <div class="font-semibold">
                    Rp {{ number_format($item->subtotal,0,',','.') }}
                </div>

            </div>

        @endforeach

        <hr class="my-4">

        <div class="flex justify-between font-bold text-lg">

            <span>Total</span>

            <span class="text-green-600">
                Rp {{ number_format($order->total_price,0,',','.') }}
            </span>

        </div>

    </div>

    <!-- Tombol -->

    <a
        href="/"
        class="block text-center bg-green-500 text-white py-3 rounded-xl font-semibold"
    >
        Kembali ke Menu
    </a>

</div>

@endsection