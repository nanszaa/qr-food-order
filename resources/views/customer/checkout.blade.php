@extends('layouts.customer.customer')
 
@section('title', 'Checkout')
 
@section('content')
 
<div class="min-h-screen bg-brand-50 font-sans">
 
    {{-- ===== HEADER ===== --}}
    <div class="bg-brand-gradient px-5 pt-6 pb-5 rounded-b-3xl shadow-header">
        <a href="javascript:history.back()" class="flex items-center gap-2 text-brand-300 text-sm mb-3">
            ← Kembali
        </a>
        <h1 class="text-white text-2xl font-extrabold tracking-tight">Checkout</h1>
        <p class="text-brand-300 text-xs mt-1">Lengkapi data pesananmu</p>
    </div>
 
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
 
        <div class="px-4 pt-5 pb-36 space-y-4">
 
            {{-- ===== NAMA PELANGGAN ===== --}}
            <div class="bg-white rounded-2xl border border-card-border shadow-card p-4">
 
                <label class="block text-neutral-heading text-sm font-bold mb-2">
                    👤 Nama Pelanggan
                </label>
 
                <input
                    type="text"
                    name="customer_name"
                    placeholder="Masukkan nama kamu..."
                    value="{{ old('customer_name') }}"
                    class="w-full border border-card-border bg-brand-50 rounded-xl px-4 py-3 text-sm text-neutral-body placeholder-neutral-hint outline-none focus:ring-2 focus:ring-brand-300 focus:border-transparent transition"
                >
 
                @error('customer_name')
                <p class="text-danger text-xs mt-2 flex items-center gap-1">
                    ⚠️ {{ $message }}
                </p>
                @enderror
 
            </div>
 
            {{-- ===== METODE PEMBAYARAN ===== --}}
            <div class="bg-white rounded-2xl border border-card-border shadow-card p-4">
 
                <label class="block text-neutral-heading text-sm font-bold mb-3">
                    💳 Metode Pembayaran
                </label>
 
                <div class="space-y-2.5">
 
                    <label class="flex items-center gap-3 p-3 rounded-xl border border-card-border bg-brand-50 cursor-pointer has-[:checked]:border-brand-400 has-[:checked]:bg-brand-100 transition">
                        <input
                            type="radio"
                            name="payment_method"
                            value="qris"
                            checked
                            class="accent-brand-600 w-4 h-4"
                        >
                        <div>
                            <p class="text-neutral-heading text-sm font-semibold">QRIS</p>
                            <p class="text-neutral-hint text-xs">Scan & bayar pakai dompet digital</p>
                        </div>
                        <span class="ml-auto text-lg">📱</span>
                    </label>
 
                    <label class="flex items-center gap-3 p-3 rounded-xl border border-card-border bg-brand-50 cursor-pointer has-[:checked]:border-brand-400 has-[:checked]:bg-brand-100 transition">
                        <input
                            type="radio"
                            name="payment_method"
                            value="cash"
                            class="accent-brand-600 w-4 h-4"
                        >
                        <div>
                            <p class="text-neutral-heading text-sm font-semibold">Bayar di Kasir</p>
                            <p class="text-neutral-hint text-xs">Bayar tunai langsung ke kasir</p>
                        </div>
                        <span class="ml-auto text-lg">💵</span>
                    </label>
 
                </div>
 
            </div>
 
            {{-- ===== RINGKASAN PESANAN ===== --}}
            <div class="bg-white rounded-2xl border border-card-border shadow-card p-4">
 
                <h2 class="text-neutral-heading text-sm font-bold mb-3">
                    🧾 Ringkasan Pesanan
                </h2>
 
                @php $total = 0; @endphp
 
                <div class="space-y-2.5">
                    @foreach($cart as $item)
                        @php
                            $subtotal = $item['price'] * $item['qty'];
                            $total += $subtotal;
                        @endphp
 
                        <div class="flex justify-between items-start gap-2">
                            <div class="flex-1">
                                <p class="text-neutral-heading text-sm font-medium">{{ $item['name'] }}</p>
                                @if(!empty($item['notes']))
                                <p class="text-neutral-hint text-xs mt-0.5">📝 {{ $item['notes'] }}</p>
                                @endif
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="text-neutral-muted text-xs">x{{ $item['qty'] }}</p>
                                <p class="text-neutral-heading text-sm font-semibold">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
 
                    @endforeach
                </div>
 
                <div class="border-t border-card-border mt-4 pt-3 flex justify-between items-center">
                    <span class="text-neutral-heading text-sm font-bold">Total</span>
                    <span class="text-brand-600 text-lg font-extrabold">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </span>
                </div>
 
            </div>
 
        </div>
 
        {{-- ===== STICKY FOOTER ===== --}}
        <div class="fixed bottom-0 left-0 right-0 z-30 bg-white border-t border-card-border px-4 pt-4 pb-6 shadow-header">
            <button
                type="submit"
                class="w-full bg-brand-gradient text-white py-4 rounded-2xl font-bold text-sm shadow-card-hover hover:opacity-90 active:scale-[0.98] transition-all"
            >
                🛍 Buat Pesanan
            </button>
        </div>
 
    </form>
 
</div>
 
@endsection