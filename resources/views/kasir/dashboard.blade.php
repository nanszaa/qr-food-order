@extends('layouts.kasir.app')

@section('title', 'Dashboard Kasir')

@section('page-title', 'Dashboard Kasir')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <div class="bg-white p-5 rounded-xl shadow">
        <p class="text-gray-500">Total Pesanan</p>
        <h3 class="text-3xl font-bold">
            {{ $totalOrders }}
        </h3>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">
        <p class="text-gray-500">Total Menu</p>
        <h3 class="text-3xl font-bold">
            {{ $totalMenus }}
        </h3>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">
        <p class="text-gray-500">Total Kategori</p>
        <h3 class="text-3xl font-bold">
            {{ $totalCategories }}
        </h3>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">
        <p class="text-gray-500">Total Meja</p>
        <h3 class="text-3xl font-bold">
            {{ $totalTables }}
        </h3>
    </div>

</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

    <div class="bg-green-500 text-white p-6 rounded-xl shadow">
        <p>Pembayaran Berhasil</p>
        <h3 class="text-3xl font-bold">
            {{ $paidPayments }}
        </h3>
    </div>

    <div class="bg-yellow-500 text-white p-6 rounded-xl shadow">
        <p>Pembayaran Pending</p>
        <h3 class="text-3xl font-bold">
            {{ $pendingPayments }}
        </h3>
    </div>

    <div class="bg-blue-600 text-white p-6 rounded-xl shadow">
        <p>Pendapatan </p>
        <h3 class="text-2xl font-bold">
            Rp {{ number_format($todayRevenue,0,',','.') }}
        </h3>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

    {{-- Grafik Pendapatan --}}
    <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow">

        <h3 class="text-lg font-bold mb-4">
            Pendapatan 7 Hari Terakhir
        </h3>

        <canvas id="revenueChart"></canvas>

    </div>

    {{-- Status Order --}}
    <div class="bg-white p-6 rounded-xl shadow">

        <h3 class="text-lg font-bold mb-4">
            Status Pesanan
        </h3>

        <canvas id="orderChart"></canvas>

    </div>

</div>

<script>

const revenueCtx =
    document.getElementById('revenueChart');

new Chart(revenueCtx, {

    type: 'line',

    data: {

        labels: @json($revenueLabels),

        datasets: [{

            label: 'Pendapatan',

            data: @json($revenueData),

            borderColor: '#2563eb',

            backgroundColor:
                'rgba(37,99,235,0.1)',

            fill: true,

            tension: 0.4

        }]
    },

    options: {

        responsive: true,

        plugins: {

            legend: {
                display: false
            }

        }

    }

});

const orderCtx =
    document.getElementById('orderChart');

new Chart(orderCtx, {

    type: 'doughnut',

    data: {

        labels: [
            'Pending',
            'Processing',
            'Completed',
            'Cancelled'
        ],

        datasets: [{

            data: [

                {{ $pendingOrders }},
                {{ $processingOrders }},
                {{ $completedOrders }},
                {{ $cancelledOrders }}

            ],

            backgroundColor: [

                '#f59e0b',
                '#3b82f6',
                '#10b981',
                '#ef4444'

            ]

        }]
    },

    options: {

        responsive: true

    }

});

</script>

@endsection