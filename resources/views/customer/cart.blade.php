@extends('layouts.customer.customer')

@section('title', 'Keranjang')

@section('content')

<div class="min-h-screen bg-brand-50 font-sans">

    {{-- ===== HEADER ===== --}}
    <div class="bg-brand-gradient px-5 pt-6 pb-5 shadow-header">
        <h1 class="text-white text-2xl font-extrabold tracking-tight">Keranjang Saya</h1>
        <p class="text-brand-300 text-xs mt-1">
            {{ count($cart) }} item dalam keranjang
        </p>
    </div>

    {{-- ===== SUCCESS ALERT ===== --}}
    @if(session('success'))
    <div
        id="success-alert"
        class="mx-4 mt-4 bg-brand-100 text-brand-700 px-4 py-3 rounded-2xl flex items-center justify-between shadow-card"
    >
        <div class="flex items-center gap-2">
            <span class="text-lg">✅</span>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
        <button
            onclick="document.getElementById('success-alert').remove()"
            class="text-brand-600 hover:text-brand-800 font-bold text-lg leading-none ml-3"
        >
            ✕
        </button>
    </div>
    @endif

    {{-- ===== CART ITEMS ===== --}}
    <div class="px-4 pt-4 pb-40">

        @forelse($cart as $item)

        <div class="bg-white rounded-2xl shadow-card border border-card-border p-4 mb-3">

            {{-- Nama & catatan --}}
            <div class="mb-3">
                <h3 class="font-bold text-neutral-heading text-sm">
                    {{ $item['name'] }}
                </h3>

                @if(!empty($item['notes']))
                <p class="text-xs text-neutral-hint mt-1 flex items-center gap-1">
                    <span>📝</span> {{ $item['notes'] }}
                </p>
                @endif

                <p class="text-xs text-neutral-muted mt-1">
                    Rp {{ number_format($item['price'], 0, ',', '.') }} / item
                </p>
            </div>

            {{-- Divider --}}
            <div class="border-t border-card-border mb-3"></div>

            {{-- Qty control & subtotal --}}
            <div class="flex justify-between items-center">

                <div class="flex items-center gap-2">

                    <form action="{{ route('cart.decrease', $item['menu_id']) }}" method="POST">
                        @csrf
                        <button
                            type="submit"
                            class="w-8 h-8 bg-danger text-white rounded-xl font-bold text-base flex items-center justify-center hover:bg-danger-dark active:scale-90 transition-all"
                        >
                            −
                        </button>
                    </form>

                    <span class="font-bold text-neutral-heading text-sm w-6 text-center">
                        {{ $item['qty'] }}
                    </span>

                    <form action="{{ route('cart.increase', $item['menu_id']) }}" method="POST">
                        @csrf
                        <button
                            type="submit"
                            class="w-8 h-8 bg-brand-600 text-white rounded-xl font-bold text-base flex items-center justify-center hover:bg-brand-700 active:scale-90 transition-all"
                        >
                            +
                        </button>
                    </form>

                </div>

                <div class="text-right">
                    <p class="text-[10px] text-neutral-hint">Subtotal</p>
                    <p class="font-extrabold text-brand-600 text-sm">
                        Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                    </p>
                </div>

            </div>

            {{-- Hapus --}}
            <div class="mt-3 text-right">
                <form action="{{ route('cart.remove', $item['menu_id']) }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="text-danger text-xs font-semibold hover:text-danger-dark transition-colors"
                    >
                        🗑 Hapus item
                    </button>
                </form>
            </div>

        </div>

        @empty

        <div class="text-center py-24">
            <p class="text-5xl mb-4">🛒</p>
            <p class="text-brand-700 font-semibold text-sm">Keranjang masih kosong</p>
            <p class="text-neutral-hint text-xs mt-1">Yuk tambahkan menu dulu!</p>
            <a
                href="/"
                class="inline-block mt-5 bg-brand-600 text-white text-sm font-semibold px-6 py-2.5 rounded-pill hover:bg-brand-700 transition-colors"
            >
                Lihat Menu
            </a>
        </div>

        @endforelse

    </div>

</div>

{{-- ===== STICKY FOOTER TOTAL ===== --}}
@php
    $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);
@endphp

@if(count($cart))
<div class="fixed bottom-0 left-0 right-0 z-30 bg-white border-t border-card-border shadow-header px-4 pt-4 pb-6">

    {{-- Ringkasan --}}
    <div class="flex justify-between items-center mb-3">
        <div>
            <p class="text-xs text-neutral-hint">Total Pembayaran</p>
            <p class="font-extrabold text-brand-700 text-lg">
                Rp {{ number_format($total, 0, ',', '.') }}
            </p>
        </div>
        <div class="text-right">
            <p class="text-xs text-neutral-hint">{{ collect($cart)->sum('qty') }} item</p>
        </div>
    </div>

    <a
        href="{{ route('checkout') }}"
        class="block text-center w-full bg-brand-gradient text-white py-3.5 rounded-2xl font-bold text-sm shadow-card-hover hover:opacity-90 active:scale-[0.98] transition-all"
    >
        Lanjut Checkout →
    </a>

</div>
@endif

@endsection