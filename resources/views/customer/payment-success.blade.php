@extends('layouts.customer.customer')

@section('title', 'Pesanan Berhasil')

@section('content')

<div class="min-h-screen bg-brand-bg flex items-center justify-center p-4 py-10">
    
    {{-- Card Wrapper untuk tampilan rapi di tengah --}}
    <div class="w-full max-w-sm bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        
        {{-- Header Status --}}
        <div class="p-6 text-center border-b border-gray-50">
            <h2 class="text-lg font-bold text-gray-800">Warkop KUY</h2>
            <div class="mt-2">
                <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                    ● Sudah dibayar
                </span>
            </div>
        </div>

        {{-- Body Informasi --}}
        <div class="p-6 space-y-4">
            {{-- List Data --}}
            <div class="space-y-3 text-xs">
                <div class="flex justify-between">
                    <span class="text-neutral-500">Waktu pembayaran</span> 
                    <span class="font-semibold">{{ $order->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-neutral-500">No Pesanan</span> 
                    <span class="font-semibold">{{ $order->order_code }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-neutral-500">Meja</span> 
                    <span class="font-semibold">{{ $order->customerSession->table->table_number ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-neutral-500">Nama Pelanggan</span> 
                    <span class="font-semibold">{{ $order->customerSession->customer_name ?? 'Guest' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-neutral-500">Metode</span> 
                    <span class="font-semibold">{{ strtoupper($order->payment->method) }}</span>
                </div>
            </div>

            <hr class="border-dashed">

            {{-- Detail Item --}}
            <div class="space-y-2 text-xs">
                @foreach($order->orderItems as $item)
                <div class="flex justify-between">
                    <span class="font-semibold">{{ $item->quantity }}x {{ $item->menu->name }}</span>
                    <span class="font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>

            <hr class="border-dashed">

            {{-- Total --}}
            <div class="flex justify-between font-bold text-sm">
                <span>Total</span>
                <span class="text-brand-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>

            {{-- Icon & Status Success --}}
            <div class="text-center pt-4">
                <div class="text-4xl mb-2">🎉</div>
                <h3 class="font-bold">Pesanan Berhasil</h3>
                <p class="text-gray-500 text-xs mt-1">Pesanan anda sedang diproses</p>
            </div>
        </div>

        {{-- Footer Buttons --}}
        <div class="p-6 pt-0 grid grid-cols-2 gap-3">
            <a href="/" class="text-center bg-brand-700 text-white py-3 rounded-lg text-xs font-semibold hover:bg-brand-800">
                Kembali ke menu →
            </a>
            <button onclick="window.print()" class="text-center text-brand-700 border border-brand-700 py-3 rounded-lg text-xs font-semibold hover:bg-brand-100">
                ⬇ Simpan PDF
            </button>
        </div>

    </div>

</div>

@endsection