@extends('layouts.kasir.app')

@section('title', 'Laporan Penjualan')

@section('page-title', 'Laporan Penjualan')

@section('content')

<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">


<div class="bg-white rounded-xl shadow-sm p-5">

    <p class="text-gray-500 text-sm">
        Pendapatan Hari Ini
    </p>

    <h2 class="text-2xl font-bold text-green-600 mt-2">
        Rp {{ number_format($todayRevenue,0,',','.') }}
    </h2>

</div>

<div class="bg-white rounded-xl shadow-sm p-5">

    <p class="text-gray-500 text-sm">
        Transaksi Hari Ini
    </p>

    <h2 class="text-2xl font-bold mt-2">
        {{ $todayTransactions }}
    </h2>

</div>

<div class="bg-white rounded-xl shadow-sm p-5">

    <p class="text-gray-500 text-sm">
        Total Revenue Filter
    </p>

    <h2 class="text-2xl font-bold text-blue-600 mt-2">
        Rp {{ number_format($totalRevenue,0,',','.') }}
    </h2>

</div>

<div class="bg-white rounded-xl shadow-sm p-5">

    <p class="text-gray-500 text-sm">
        Total Transaksi
    </p>

    <h2 class="text-2xl font-bold mt-2">
        {{ $payments->count() }}
    </h2>

</div>


</div>

<div class="bg-white rounded-xl shadow-sm p-6 mb-8">


<h3 class="font-bold text-lg mb-4">
    Filter Laporan
</h3>

<form method="GET">

    <div class="grid md:grid-cols-3 gap-4">

        <div>

            <label class="block text-sm mb-2">
                Tanggal Awal
            </label>

            <input
                type="date"
                name="start_date"
                value="{{ request('start_date') }}"
                class="w-full border rounded-lg px-4 py-3"
            >

        </div>

        <div>

            <label class="block text-sm mb-2">
                Tanggal Akhir
            </label>

            <input
                type="date"
                name="end_date"
                value="{{ request('end_date') }}"
                class="w-full border rounded-lg px-4 py-3"
            >

        </div>

        <div class="flex items-end">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg"
            >
                Filter
            </button>

        </div>

    </div>

</form>


</div>

<div class="grid lg:grid-cols-3 gap-6 mb-8">


<div class="lg:col-span-1">

    <div class="bg-white rounded-xl shadow-sm p-6">

        <h3 class="font-bold text-lg mb-4">
            Top 5 Menu Terlaris
        </h3>

        @forelse($bestSellingMenus as $index => $menu)

            <div class="flex justify-between py-3 border-b">

                <div>

                    <p class="font-semibold">
                        #{{ $index + 1 }}
                    </p>

                    <p class="text-sm text-gray-600">
                        {{ $menu->menu->name }}
                    </p>

                </div>

                <div class="font-bold text-green-600">

                    {{ $menu->total_sold }}x

                </div>

            </div>

        @empty

            <p class="text-gray-500">
                Belum ada data penjualan
            </p>

        @endforelse

    </div>

</div>

<div class="lg:col-span-2">

    <div class="bg-white rounded-xl shadow-sm p-6">

        <h3 class="font-bold text-lg mb-4">
            Daftar Transaksi
        </h3>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b">

                        <th class="text-left py-3">
                            Order
                        </th>

                        <th class="text-left py-3">
                            Metode
                        </th>

                        <th class="text-left py-3">
                            Nominal
                        </th>

                        <th class="text-left py-3">
                            Tanggal
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($payments as $payment)

                        <tr class="border-b">

                            <td class="py-3">
                                {{ $payment->order->order_code }}
                            </td>

                            <td class="py-3">
                                {{ strtoupper($payment->method) }}
                            </td>

                            <td class="py-3 font-semibold text-green-600">
                                Rp {{ number_format($payment->amount,0,',','.') }}
                            </td>

                            <td class="py-3">
                                {{ \Carbon\Carbon::parse($payment->paid_at)->format('d-m-Y H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="py-6 text-center text-gray-500">
                                Belum ada transaksi
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


</div>

@endsection
