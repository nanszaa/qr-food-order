@extends('layouts.customer.customer')

@section('title', 'Keranjang')

@section('content')

    @php
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);
    @endphp

    <div class="min-h-screen bg-brand-bg">

        <div class="max-w-7xl mx-auto px-4 lg:px-4 py-6">

            {{-- ===== HEADER ===== --}}
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-3">

                <div class="flex items-center justify-between w-full">
                    <h1 class="text-2xl font-bold">
                        Keranjang Saya
                    </h1>

                    <p class="text-xs bg-brand-100 p-2 rounded-lg font-semibold text-brand-600">
                        #ORD-ADOCUWS
                    </p>
                </div>
            </div>

            {{-- ===== SUCCESS ALERT ===== --}}
            @if(session('success'))
                <div id="success-alert"
                    class="mx-4 mt-4 bg-brand-100 text-brand-700 px-4 py-3 rounded-2xl flex items-center justify-between shadow-card">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">✅</span>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                    <button onclick="document.getElementById('success-alert').remove()"
                        class="text-brand-600 hover:text-brand-800 font-bold text-lg leading-none ml-3">
                        ✕
                    </button>
                </div>
            @endif

            {{-- ===== CART ITEMS ===== --}}
            <div class="flex flex-col lg:flex-row xl:flex-row gap-6">

                <div class="flex-1">

                    <div class="flex justify-end mb-6">
                        <p class="text-xs bg-brand-100 p-2 rounded-lg font-semibold text-brand-600">
                            {{ count($cart) }} item dalam keranjang
                        </p>
                    </div>

                    @forelse($cart as $item)
                        <div class="bg-neutral-50 border border-neutral-200 rounded-lg p-4 flex gap-3 mb-6">
                            <div class="w-32 h-32 bg-gray-300 rounded flex-shrink-0">
                                <img src="https://placehold.co/600x400?text=Placeholder" class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between">

                                    {{-- ===== ITEM NAME ===== --}}
                                    <div>
                                        <h3 class="font-medium">
                                            {{ $item['name'] }}
                                        </h3>
                                    </div>
                                    {{-- ===== /ITEM NAME ===== --}}

                                    {{-- ===== DELETE BUTTON ===== --}}
                                    <form action="{{ route('cart.remove', $item['menu_id']) }}" method="POST">
                                        @csrf
                                        <button class="text-red-500">
                                            ✕
                                        </button>
                                    </form>
                                    {{-- ===== /DELETE BUTTON ===== --}}

                                </div>

                                {{-- ===== NOTE TEXTAREA ===== --}}
                                <div class="mt-3">
                                    <textarea name="notes[{{ $item['menu_id'] }}]" rows="1" placeholder="Tambahkan catatan.."
                                        class="w-full bg-neutral-100 border border-neutral-200 rounded-lg p-2 resize-none outline-none focus:ring focus:ring-brand-200">{{ $item['notes'] ?? '' }}</textarea>
                                </div>
                                {{-- ===== /NOTE TEXTAREA ===== --}}

                                <div class="mt-3 flex justify-between items-end">

                                    {{-- ===== PRICE ===== --}}
                                    <div class="text-green-700 font-bold">
                                        Rp {{ number_format($item['price'], 0, ',', '.') }}
                                    </div>
                                    {{-- ===== /PRICE ===== --}}

                                    {{-- ===== QTY CONTROL ===== --}}
                                    <div class="inline-flex items-center border border-neutral-200 rounded">
                                        <form action="{{ route('cart.decrease', $item['menu_id']) }}" method="POST">
                                            @csrf
                                            <button class="w-8 h-8">
                                                -
                                            </button>
                                        </form>
                                        <div class="w-px self-stretch bg-gray-200"></div>
                                        <span class="w-8 text-center flex items-center justify-center">
                                            {{ $item['qty'] }}
                                        </span>
                                        <div class="w-px self-stretch bg-gray-200"></div>
                                        <form action="{{ route('cart.increase', $item['menu_id']) }}" method="POST">
                                            @csrf
                                            <button class="w-8 h-8">
                                                +
                                            </button>
                                        </form>
                                    </div>
                                    {{-- ===== /QTY CONTROL ===== --}}
                                </div>
                            </div>
                        </div>



                    @empty

                        <div class="text-center py-24">
                            <p class="text-5xl mb-4">🛒</p>
                            <p class="text-brand-700 font-semibold text-sm">Keranjang masih kosong</p>
                            <p class="text-neutral-hint text-xs mt-1">Yuk tambahkan menu dulu!</p>
                            <a href="/"
                                class="inline-block mt-5 bg-brand-600 text-white text-sm font-semibold px-6 py-2.5 rounded-pill hover:bg-brand-700 transition-colors">
                                Lihat Menu
                            </a>
                        </div>

                    @endforelse

                    <a href="{{ route('home') }}"
                        class="block text-center bg-brand-700 text-white rounded-lg py-3 hover:bg-brand-800 transition">
                        Tambah Menu
                    </a>

                </div>

                {{-- ===== RINGKASAN PESANAN ===== --}}
                <div class="lg:w-80 xl:w-80 flex-shrink-0">
                    <div class="bg-neutral-50 rounded-lg border border-neutral-200 p-5">
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
                        <a href="{{ route('checkout') }}"
                            class="mt-5 block text-center bg-brand-700 text-white rounded-lg py-3 hover:bg-brand-800 transition">
                            Pilih metode pembayaran →
                        </a>
                    </div>
                </div>
                {{-- ===== /RINGKASAN PESANAN ===== --}}
            </div>
            {{-- ===== /CART ITEMS ===== --}}
        </div>
    </div>


@endsection