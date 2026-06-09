@extends('layouts.customer.customer')

@section('title', 'Pembayaran')

@section('content')


<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">
        Pembayaran QRIS
    </h1>

    <p class="mb-2">
        No Pesanan:
        <span class="font-semibold">
            {{ $order->order_code }}
        </span>
    </p>

    <p class="mb-6">
        Total:
        <span class="font-semibold text-green-600">
            Rp {{ number_format($order->total_price, 0, ',', '.') }}
        </span>
    </p>

    <button
        id="pay-button"
        class="w-full bg-green-500 text-white py-3 rounded-xl font-semibold"
    >
        Buka QRIS Midtrans
    </button>

    <p class="text-center text-xs text-gray-500 mt-4">
        Sandbox Mode (Development)
    </p>

</div>

<script>

document
    .getElementById('pay-button')
    .addEventListener('click', function () {

        snap.pay('{{ $payment->payment_token }}', {

            onSuccess: function(result) {

                window.location.href =
                    "/payment/success/{{ $order->order_id }}";

            },

            onPending: function(result) {

                alert('Menunggu pembayaran');

            },

            onError: function(result) {

                alert('Pembayaran gagal');

            }

        });

    });

</script>

@endsection