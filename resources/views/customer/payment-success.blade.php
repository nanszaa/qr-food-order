@extends('layouts.customer.customer')

@section('title', 'Pesanan Berhasil')

@section('content')

<div class="min-h-screen bg-brand-50 font-sans pb-10">

    {{-- ===== HERO SUCCESS ===== --}}
    <div class="bg-brand-gradient px-5 pt-10 pb-8 rounded-b-3xl shadow-header text-center">
        <div class="text-6xl mb-3">🎉</div>
        <h1 class="text-white text-2xl font-extrabold tracking-tight">Pesanan Berhasil!</h1>
        <p class="text-brand-300 text-sm mt-2">Pesanan kamu sedang diproses</p>
    </div>

    <div class="px-4 pt-5 pb-10 space-y-4">

        {{-- ===== INFORMASI PESANAN ===== --}}
        <div class="bg-white rounded-2xl border border-card-border shadow-card p-4">

            <h2 class="text-neutral-heading text-sm font-bold mb-3">📋 Informasi Pesanan</h2>

            <div class="space-y-2.5">

                <div class="flex justify-between items-center">
                    <span class="text-neutral-hint text-xs">No. Pesanan</span>
                    <span class="text-neutral-heading text-sm font-bold tracking-wide">
                        {{ $order->order_code }}
                    </span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-neutral-hint text-xs">Nama Pelanggan</span>
                    <span class="text-neutral-heading text-sm font-semibold">
                        {{ $order->customerSession->customer_name ?? 'Guest' }}
                    </span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-neutral-hint text-xs">Meja</span>
                    <span class="text-neutral-heading text-sm font-semibold">
                        Meja {{ $order->customerSession->table->table_number ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-neutral-hint text-xs">Status Pesanan</span>
                    <span class="bg-amber-100 text-amber-600 text-xs font-bold px-3 py-1 rounded-pill">
                        ⏳ {{ ucfirst($order->order_status) }}
                    </span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-neutral-hint text-xs">Metode Pembayaran</span>
                    <span class="bg-brand-100 text-brand-600 text-xs font-bold px-3 py-1 rounded-pill">
                        {{ strtoupper($order->payment->method) }}
                    </span>
                </div>

            </div>

        </div>

        {{-- ===== DETAIL MENU ===== --}}
        <div class="bg-white rounded-2xl border border-card-border shadow-card p-4">

            <h2 class="text-neutral-heading text-sm font-bold mb-3">🍽️ Detail Pesanan</h2>

            <div class="space-y-3">
                @foreach($order->orderItems as $item)
                <div class="flex justify-between items-start gap-2">
                    <div class="flex-1">
                        <p class="text-neutral-heading text-sm font-semibold">
                            {{ $item->menu->name }}
                        </p>
                        <p class="text-neutral-hint text-xs mt-0.5">
                            {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                        </p>
                    </div>
                    <span class="text-neutral-heading text-sm font-bold flex-shrink-0">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </span>
                </div>
                @endforeach
            </div>

            <div class="border-t border-card-border mt-4 pt-3 flex justify-between items-center">
                <span class="text-neutral-heading text-sm font-bold">Total</span>
                <span class="text-brand-600 text-lg font-extrabold">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </span>
            </div>

        </div>

        {{-- ===== TOMBOL ===== --}}
        <a
            href="/"
            class="block text-center w-full bg-brand-gradient text-white py-4 rounded-2xl font-bold text-sm shadow-card-hover hover:opacity-90 active:scale-[0.98] transition-all"
        >
            🏠 Kembali ke Menu
        </a>

    </div>

</div>

@endsection