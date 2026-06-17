@extends('layouts.kasir.app')

@section('title', 'Detail Meja')

@section('page-title', 'Detail Meja')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <h2 class="text-3xl font-bold mb-2">
        Meja {{ $table->table_number }}
    </h2>

    <p class="text-gray-500">
        QR Token :
        {{ $table->qr_token }}
    </p>

</div>

@forelse($table->customerSessions as $session)

    @php

        $totalSession = $session->orders->sum('total_price');

        $totalOrders = $session->orders->count();

    @endphp

   <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mt-6">

    @php

        $totalSession = $session->orders->sum('total_price');

        $totalOrders = $session->orders->count();

        $totalItems = 0;

        foreach($session->orders as $order){

            foreach($order->orderItems as $item){

                $totalItems += $item->quantity;

            }

        }

    @endphp

    <div class="flex justify-between items-start mb-6">

        <div>

            <h3 class="text-2xl font-bold text-gray-800">
                {{ $session->customer_name }}
            </h3>

            <p class="text-gray-500 mt-1">
                Session dimulai
                {{ $session->created_at->format('d M Y H:i') }}
            </p>

        </div>

        <span class="
            px-4 py-2 rounded-full text-sm font-semibold
            {{ $session->status === 'active'
                ? 'bg-green-100 text-green-700'
                : 'bg-gray-100 text-gray-600' }}
        ">
            {{ ucfirst($session->status) }}
        </span>

    </div>

    <div class="grid md:grid-cols-3 gap-4 mb-6">

        <div class="bg-gray-50 rounded-xl p-4">

            <p class="text-sm text-gray-500">
                Total Order
            </p>

            <h4 class="text-3xl font-bold mt-2">
                {{ $totalOrders }}
            </h4>

        </div>

        <div class="bg-gray-50 rounded-xl p-4">

            <p class="text-sm text-gray-500">
                Total Item
            </p>

            <h4 class="text-3xl font-bold mt-2">
                {{ $totalItems }}
            </h4>

        </div>

        <div class="bg-green-50 rounded-xl p-4">

            <p class="text-sm text-green-700">
                Total Belanja
            </p>

            <h4 class="text-3xl font-bold text-green-700 mt-2">
                Rp {{ number_format($totalSession,0,',','.') }}
            </h4>

        </div>

    </div>

    <div class="border rounded-xl overflow-hidden">

        <div class="bg-gray-50 px-4 py-3 font-semibold">
            Riwayat Order
        </div>

        @foreach($session->orders as $order)

            <div class="flex justify-between items-center px-4 py-4 border-t">

                <div>

                    <p class="font-semibold">
                        {{ $order->order_code }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ ucfirst($order->order_status) }}
                    </p>

                </div>

                <div class="text-right">

                    <p class="font-bold">
                        Rp {{ number_format(
                            $order->total_price,
                            0,
                            ',',
                            '.'
                        ) }}
                    </p>

                    <a
                        href="{{ route(
                            'kasir.orders.show',
                            $order->order_id
                        ) }}"
                        class="text-green-700 text-sm"
                    >
                        Lihat Detail
                    </a>

                </div>

            </div>

        @endforeach

    </div>

    @if($session->status === 'active')

        <div class="mt-6 flex justify-end">

            <form
                action="{{ route(
                    'kasir.sessions.close',
                    $session->customer_session_id
                ) }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    onclick="return confirm('Selesaikan session ini?')"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-semibold"
                >
                    Selesaikan Session
                </button>

            </form>

        </div>

    @endif

</div>

@empty

    <div class="bg-white rounded-xl shadow p-6 mt-6">

        <p class="text-gray-500">
            Belum ada pelanggan pada meja ini
        </p>

    </div>

@endforelse

@endsection