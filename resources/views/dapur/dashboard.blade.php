@extends('layouts.dapur.app')

@section('title', 'Dashboard Dapur')

@section('content')

<div class="h-full overflow-y-auto p-8">


<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-800">
        Dashboard Dapur
    </h1>

    <p class="text-gray-500 mt-1">
        Monitor aktivitas dapur hari ini
    </p>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <div class="bg-white rounded-2xl p-6 shadow-sm">

        <p class="text-sm text-gray-500">
            Pesanan Baru
        </p>

        <h2 class="text-4xl font-bold text-red-500 mt-2">
            {{ $pendingCount }}
        </h2>

    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm">

        <p class="text-sm text-gray-500">
            Sedang Dimasak
        </p>

        <h2 class="text-4xl font-bold text-orange-500 mt-2">
            {{ $cookingCount }}
        </h2>

    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm">

        <p class="text-sm text-gray-500">
            Siap Diantar
        </p>

        <h2 class="text-4xl font-bold text-green-500 mt-2">
            {{ $readyCount }}
        </h2>

    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm">

        <p class="text-sm text-gray-500">
            Selesai Hari Ini
        </p>

        <h2 class="text-4xl font-bold text-blue-500 mt-2">
            {{ $servedCount }}
        </h2>

    </div>

</div>

<div class="mt-8 bg-white rounded-2xl p-6 shadow-sm">

    <h2 class="text-lg font-semibold text-gray-800 mb-4">
        Informasi Dapur
    </h2>

    <div class="space-y-2 text-gray-600">

        <p>
            Staff Aktif :
            <span class="font-semibold">
                {{ auth()->user()->name }}
            </span>
        </p>

        <p>
            Total Pesanan Aktif :
            <span class="font-semibold">
                {{ $pendingCount + $cookingCount + $readyCount }}
            </span>
        </p>

    </div>

</div>


</div>

@endsection
