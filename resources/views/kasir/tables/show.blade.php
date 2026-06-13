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

    <div class="bg-white rounded-xl shadow p-6 mt-6">

        <h3 class="text-xl font-semibold mb-3">
            Session Pelanggan
        </h3>

        <p>
            Nama :
            {{ $session->customer_name }}
        </p>

        <p>
            Mulai :
            {{ $session->created_at }}
        </p>

    </div>

    <div class="bg-white rounded-xl shadow p-6 mt-6">

        <h3 class="text-xl font-semibold mb-4">
            Daftar Pesanan
        </h3>

        @forelse($session->orders as $order)

            <div class="border rounded-lg p-4 mb-3">

                <p>
                    <strong>
                        {{ $order->order_code }}
                    </strong>
                </p>

                <p>
                    Status :
                    {{ ucfirst($order->order_status) }}
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

                <a
                    href="{{ route(
                        'kasir.orders.show',
                        $order->order_id
                    ) }}"
                    class="inline-block mt-3 bg-green-700 text-white px-4 py-2 rounded-lg"
                >
                    Lihat Detail
                </a>

            </div>

        @empty

            <p class="text-gray-500">
                Belum ada pesanan
            </p>

        @endforelse

    </div>

@empty

    <div class="bg-white rounded-xl shadow p-6 mt-6">

        <p class="text-gray-500">
            Belum ada pelanggan pada meja ini
        </p>

    </div>

@endforelse

@endsection