@extends('layouts.customer.customer')

@section('title', 'Checkout')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-bold mb-6">
        Checkout
    </h1>

    <form action="{{ route('checkout.process') }}" method="POST">

        @csrf

        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Nama Pelanggan
            </label>

            <input
                type="text"
                name="customer_name"
                class="w-full border rounded-xl p-3"
                placeholder="Masukkan Nama Pelanggan"
            >

            @error('customer_name')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <div class="mb-6">

            <label class="block mb-2 font-medium">
                Metode Pembayaran
            </label>

            <div class="space-y-3">

                <label class="flex items-center gap-2">

                    <input
                        type="radio"
                        name="payment_method"
                        value="qris"
                        checked
                    >

                    QRIS
                </label>

                <label class="flex items-center gap-2">

                    <input
                        type="radio"
                        name="payment_method"
                        value="cash"
                    >

                    Bayar di Kasir
                </label>

            </div>

        </div>

        <div class="bg-gray-100 rounded-xl p-4 mb-6">

            <h2 class="font-semibold mb-3">
                Ringkasan Pesanan
            </h2>

            @php
                $total = 0;
            @endphp

            @foreach($cart as $item)

                @php
                    $subtotal = $item['price'] * $item['qty'];
                    $total += $subtotal;
                @endphp

                <div class="flex justify-between mb-2">

                    <span>
                        {{ $item['name'] }}
                        x {{ $item['qty'] }}
                    </span>

                    <span>
                        Rp {{ number_format($subtotal,0,',','.') }}
                    </span>

                </div>

            @endforeach

            <hr class="my-3">

            <div class="flex justify-between font-bold">

                <span>Total</span>

                <span>
                    Rp {{ number_format($total,0,',','.') }}
                </span>

            </div>

        </div>

        <button
            type="submit"
            class="w-full bg-green-500 text-white py-3 rounded-xl font-semibold"
        >
            Buat Pesanan
        </button>

    </form>

</div>

@endsection