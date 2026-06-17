@extends('layouts.customer.customer')

@section('title', 'Checkout')

@section('content')

    @php $total = 0; @endphp

    <div class="min-h-screen bg-brand-bg">


        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            <div class="max-w-7xl mx-auto px-4 lg:px-6 py-6">

                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-3">

                    <div class="flex items-center justify-between w-full">
                        <h1 class="text-2xl font-bold">
                            Checkout
                        </h1>

                        <p class="text-xs bg-brand-100 p-2 rounded-lg font-semibold text-brand-600">
                            #ORD-ADOCUWS
                        </p>
                    </div>

                </div>

                <div class="flex flex-col lg:flex-row xl:flex-row gap-3">

                    <div class="flex-1 space-y-3">

                        {{-- ===== NAMA PELANGGAN INPUT ===== --}}
                        <div class="bg-white rounded-2xl border border-neutral-200 p-4 shadow-sm">

                            <label class="block text-sm font-medium mb-2">
                                Nama Pemesan
                            </label>

                            <input type="text" name="customer_name" placeholder="Masukkan nama"
                                value="{{ old('customer_name') }}"
                                class="w-full rounded-xl border border-neutral-200 px-4 py-3 text-sm">

                                 @error('customer_name')
                                <p class="text-danger text-xs mt-2 flex items-center gap-1">
                                    ⚠️ {{ $message }}
                                </p>
                            @enderror

                        </div>
                        {{-- ===== /NAMA PELANGGAN INPUT ===== --}}

                        @foreach($cart as $item)
                            @php
                                $subtotal = $item['price'] * $item['qty'];
                                $total += $subtotal;
                            @endphp

                            <div class="bg-white rounded-2xl border border-neutral-200 p-4 shadow-sm flex gap-4">

                                <div class="w-24 h-24 bg-gray-300 rounded flex-shrink-0">
                                    <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">

                                        @if(!empty($item['image']))
                                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <img src="https://placehold.co/300x300/e5e7eb/6b7280?text=Menu" alt="Menu"
                                                class="w-full h-full object-cover">
                                        @endif

                                    </div>
                                </div>

                                <div class="flex-1 h-24 flex flex-col justify-between">

                                    <div class="flex justify-between items-start">

                                        <div>

                                            <h3 class="font-medium">
                                                {{ $item['name'] }}
                                            </h3>

                                            @if(!empty($item['notes']))
                                                <p class="text-xs text-gray-400">
                                                    {{ $item['notes'] }}
                                                </p>
                                            @endif

                                        </div>

                                        <span class="text-xs border border-neutral-200 rounded-full px-2 py-0.5">
                                            x{{ $item['qty'] }}
                                        </span>

                                    </div>

                                    <div class="mt-2 text-brand-700 font-bold">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </div>

                                </div>

                            </div>

                        @endforeach
                    </div>

                    <div class="flex-1 space-y-3">

                        {{-- ===== METODE PEMBAYARAN ===== --}}
                        <div class="bg-neutral-50 border rounded-lg p-4">

                            <h3 class="font-semibold mb-4">
                                Pilih metode pembayaran
                            </h3>

                            <div class="space-y-2 text-sm">

                                <label class="flex items-center gap-2">
                                    <input type="radio" name="payment_method" value="qris" checked>
                                    <span>QRIS</span>
                                </label>

                                <label class="flex items-center gap-2">
                                    <input type="radio" name="payment_method" value="bni">
                                    <span>Virtual Account BNI</span>
                                </label>

                                <label class="flex items-center gap-2">
                                    <input type="radio" name="payment_method" value="bri">
                                    <span>Virtual Account BRI</span>
                                </label>

                                <label class="flex items-center gap-2">
                                    <input type="radio" name="payment_method" value="permata">
                                    <span>Virtual Account Permata</span>
                                </label>

                                <label class="flex items-center gap-2">
                                    <input type="radio" name="payment_method" value="cash">
                                    <span>Bayar di kasir</span>
                                </label>

                            </div>
                        </div>
                        {{-- ===== /METODE PEMBAYARAN ===== --}}

                        <div class="bg-neutral-50 border rounded-lg p-4">
                            <h3 class="font-semibold mb-4">
                                Ringkasan Pesanan
                            </h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-neutral-500">Subtotal</span>
                                    <span class="font-semibold">
                                        Rp {{ number_format($total, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-neutral-500">Service Charge</span>
                                    <span class="font-semibold">Rp 0</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-neutral-500">Pajak</span>
                                    <span class="font-semibold">Rp 0</span>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="flex justify-between font-semibold">
                                <span>Total</span>
                                <span class="text-brand-700">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>

                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                            <a href="{{ route('home') }}" class="bg-brand-700 text-white rounded-lg py-3 text-center">
                                ✕ Tambah menu
                            </a>

                            <button type="submit" class="border border-brand-700 text-brand-700 rounded-lg py-3">
                                Lanjut Pembayaran →
                            </button>

                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>

@endsection