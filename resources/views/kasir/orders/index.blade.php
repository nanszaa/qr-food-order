@extends('layouts.kasir.app')

@section('title', 'Orders')

@section('page-title', 'Order Management')

@section('content')

{{-- SUMMARY --}}

<div class="flex gap-4 mb-8 flex-wrap">

```
<div class="bg-white rounded-xl px-5 py-3 shadow-sm border">
    🔴 Pending ({{ $pendingCount }})
</div>

<div class="bg-white rounded-xl px-5 py-3 shadow-sm border">
    🟠 Processing ({{ $processingCount }})
</div>

<div class="bg-white rounded-xl px-5 py-3 shadow-sm border">
    🟢 Completed ({{ $completedCount }})
</div>

<div class="bg-white rounded-xl px-5 py-3 shadow-sm border">
    ⚫ Cancelled ({{ $cancelledCount }})
</div>

</div>

{{-- FILTER --}}

<div class="flex flex-wrap gap-3 mb-8">

<a href="{{ route('kasir.orders') }}"
   class="px-4 py-2 bg-white rounded-xl border hover:bg-gray-50">
    Semua
</a>

<a href="{{ route('kasir.orders', ['status' => 'pending']) }}"
   class="px-4 py-2 bg-red-100 text-red-700 rounded-xl">
    Pending
</a>

<a href="{{ route('kasir.orders', ['status' => 'processing']) }}"
   class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-xl">
    Processing
</a>

<a href="{{ route('kasir.orders', ['status' => 'completed']) }}"
   class="px-4 py-2 bg-green-100 text-green-700 rounded-xl">
    Completed
</a>

<a href="{{ route('kasir.orders', ['status' => 'cancelled']) }}"
   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl">
    Cancelled
</a>

</div>

{{-- ORDER LIST --}}

<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5">

@forelse($orders as $order)

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">

    <div class="flex justify-between items-start">

        <div>

            <h2 class="font-bold text-lg">
                {{ $order->order_code }}
            </h2>

            <p class="text-sm text-gray-500">
                Meja {{ $order->customerSession->table->table_number }}
            </p>

        </div>

        @if($order->order_status == 'pending')

            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                Pending
            </span>

        @elseif($order->order_status == 'processing')

            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                Processing
            </span>

        @elseif($order->order_status == 'completed')

            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                Completed
            </span>

        @else

            <span class="px-3 py-1 rounded-full bg-gray-200 text-gray-700 text-sm">
                Cancelled
            </span>

        @endif

    </div>

    <div class="mt-4">

        <p class="text-sm text-gray-500">
            Customer
        </p>

        <p class="font-medium">
            {{ $order->customerSession->customer_name }}
        </p>

    </div>

    <div class="mt-4">

        <p class="text-sm text-gray-500">
            Total
        </p>

        <p class="font-bold text-green-700 text-lg">
            Rp {{ number_format($order->total_price,0,',','.') }}
        </p>

    </div>

    <div class="mt-4">

        @if($order->payment->status == 'paid')

            <span class="text-green-600 font-medium">
                ✓ Paid
            </span>

        @else

            <span class="text-red-600 font-medium">
                ⏳ Pending Payment
            </span>

        @endif

    </div>

    <div class="mt-6">

        <a
            href="{{ route('kasir.orders.show', $order->order_id) }}"
            class="block text-center bg-green-700 hover:bg-green-800 text-white py-3 rounded-xl font-medium transition"
        >
            Lihat Detail
        </a>

    </div>

</div>

@empty

<div class="col-span-full bg-white rounded-xl p-8 text-center text-gray-500">

    Belum ada pesanan

</div>

@endforelse

</div>

@endsection
