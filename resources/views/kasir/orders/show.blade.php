@extends('layouts.kasir.app')

@section('title', 'Detail Pesanan')

@section('page-title', 'Detail Pesanan')

@section('content')

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
    {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Informasi Pesanan --}}
    <div class="lg:col-span-2">

        <div class="bg-white rounded-xl shadow p-6">

            <div class="flex justify-between items-start mb-6">

                <div>
                    <h2 class="text-2xl font-bold">
                        {{ $order->order_code }}
                    </h2>

                    <p class="text-gray-500">
                        Meja {{ $order->customerSession->table->table_number }}
                    </p>

                    <p class="text-gray-500">
                        {{ $order->customerSession->customer_name }}
                    </p>
                </div>

                <div>
                    @if($order->order_status == 'pending')
                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm">
                            Pending
                        </span>

                    @elseif($order->order_status == 'processing')
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                            Processing
                        </span>

                    @elseif($order->order_status == 'completed')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            Completed
                        </span>

                    @elseif($order->order_status == 'cancelled')
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                            Cancelled
                        </span>
                    @endif
                </div>

            </div>

            <div class="border-t pt-4">

                @foreach($order->orderItems as $item)

                <div class="flex justify-between py-3 border-b">

                    <div>
                        <p class="font-semibold">
                            {{ $item->menu->name }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Qty : {{ $item->quantity }}
                        </p>
                    </div>

                    <div class="font-semibold">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </div>

                </div>

                @endforeach

            </div>

            <div class="flex justify-between mt-6 pt-4 border-t">

                <span class="font-semibold">
                    Total Pesanan
                </span>

                <span class="text-xl font-bold text-green-700">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </span>

            </div>

        </div>

    </div>

    {{-- Sidebar --}}
    <div>

        {{-- Status Order --}}
        <div class="bg-white rounded-xl shadow p-6 mb-6">

            <h3 class="font-bold text-lg mb-4">
                Status Pesanan
            </h3>

            <form
                action="{{ route(
                    'kasir.orders.update-status',
                    $order->order_id
                ) }}"
                method="POST"
            >
                @csrf

                <select
                    name="order_status"
                    class="w-full border rounded-lg px-4 py-3"
                >
                    <option value="pending"
                        {{ $order->order_status == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="processing"
                        {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                        Processing
                    </option>

                    <option value="completed"
                        {{ $order->order_status == 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>

                    <option value="cancelled"
                        {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>
                        Cancelled
                    </option>
                </select>

                <button
                    type="submit"
                    class="w-full mt-4 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg"
                >
                    Update Status
                </button>

            </form>

        </div>

        {{-- Payment --}}
        <div class="bg-white rounded-xl shadow p-6">

            <h3 class="font-bold text-lg mb-4">
                Pembayaran
            </h3>

            <div class="space-y-3">

                <p>
                    <span class="font-medium">Status :</span>

                    @if($order->payment->status == 'paid')

                        <span class="text-green-600 font-semibold">
                            Paid
                        </span>

                    @else

                        <span class="text-red-600 font-semibold">
                            Pending
                        </span>

                    @endif
                </p>

                <p>
                    <span class="font-medium">Metode :</span>
                    {{ strtoupper($order->payment->method) }}
                </p>

                @if($order->payment->paid_at)

                <p>
                    <span class="font-medium">Dibayar :</span><br>

                    {{ \Carbon\Carbon::parse(
                        $order->payment->paid_at
                    )->format('d-m-Y H:i') }}
                </p>

                @endif

            </div>

            @if(
                $order->payment->method === 'cash'
                &&
                $order->payment->status === 'pending'
            )

            <form
                action="{{ route(
                    'kasir.payment.confirm',
                    $order->payment->payment_id
                ) }}"
                method="POST"
                class="mt-5"
            >
                @csrf

                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg"
                >
                    Konfirmasi Pembayaran
                </button>

            </form>

            @endif

            <a
                href="{{ route(
                    'kasir.orders.receipt',
                    $order->order_id
                ) }}"
                target="_blank"
                class="block text-center mt-4 bg-gray-800 hover:bg-gray-900 text-white py-3 rounded-lg"
            >
                Cetak Struk
            </a>

        </div>

    </div>

</div>

@endsection