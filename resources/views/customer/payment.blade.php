@extends('layouts.customer.customer')

@section('title', 'Pembayaran')

@section('content')

<div class="min-h-screen bg-brand-50 font-sans">

    {{-- ===== HEADER ===== --}}
    <div class="bg-brand-gradient px-5 pt-6 pb-5 rounded-b-3xl shadow-header">
        <h1 class="text-white text-2xl font-extrabold tracking-tight">Pembayaran</h1>
        <p class="text-brand-300 text-xs mt-1">Selesaikan pembayaran untuk mengonfirmasi pesanan</p>
    </div>

    <div class="px-4 pt-5 pb-10 space-y-4">

        {{-- ===== INFO PESANAN ===== --}}
        <div class="bg-white rounded-2xl border border-card-border shadow-card p-4">

            <h2 class="text-neutral-heading text-sm font-bold mb-3">🧾 Detail Pesanan</h2>

            <div class="space-y-2.5">
                <div class="flex justify-between items-center">
                    <span class="text-neutral-hint text-xs">No. Pesanan</span>
                    <span class="text-neutral-heading text-sm font-bold tracking-wide">
                        {{ $order->order_code }}
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-neutral-hint text-xs">Metode</span>
                    <span class="bg-brand-100 text-brand-600 text-xs font-semibold px-3 py-1 rounded-pill">
                        📱 QRIS
                    </span>
                </div>
                <div class="border-t border-card-border pt-2.5 flex justify-between items-center">
                    <span class="text-neutral-heading text-sm font-bold">Total Pembayaran</span>
                    <span class="text-brand-600 text-lg font-extrabold">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </span>
                </div>
            </div>

        </div>

        {{-- ===== PANDUAN ===== --}}
        <div class="bg-brand-100 rounded-2xl border border-brand-200 p-4">
            <h2 class="text-brand-700 text-sm font-bold mb-2.5">📋 Cara Bayar</h2>
            <ol class="space-y-1.5 text-brand-700 text-xs list-none">
                <li class="flex items-start gap-2">
                    <span class="bg-brand-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">1</span>
                    Tekan tombol <strong>"Buka QRIS"</strong> di bawah
                </li>
                <li class="flex items-start gap-2">
                    <span class="bg-brand-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">2</span>
                    Scan QR code menggunakan aplikasi dompet digital
                </li>
                <li class="flex items-start gap-2">
                    <span class="bg-brand-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">3</span>
                    Konfirmasi pembayaran di aplikasimu
                </li>
            </ol>
        </div>

        {{-- ===== TOMBOL BAYAR ===== --}}
        <button
            id="pay-button"
            class="w-full bg-brand-gradient text-white py-4 rounded-2xl font-bold text-sm shadow-card-hover hover:opacity-90 active:scale-[0.98] transition-all flex items-center justify-center gap-2"
        >
            <span>📱</span>
            <span>Buka QRIS Midtrans</span>
        </button>

        {{-- Sandbox badge --}}
        <p class="text-center text-xs text-neutral-hint flex items-center justify-center gap-1.5">
            <span class="inline-block w-1.5 h-1.5 rounded-full bg-neutral-hint"></span>
            Sandbox Mode (Development)
        </p>

    </div>

</div>

<script>
    document.getElementById('pay-button').addEventListener('click', function () {

        snap.pay('{{ $payment->payment_token }}', {

            onSuccess: function (result) {
                window.location.href = "/payment/success/{{ $order->order_id }}";
            },

            onPending: function (result) {
                alert('Menunggu pembayaran');
            },

            onError: function (result) {
                alert('Pembayaran gagal');
            }

        });

    });
</script>

@endsection