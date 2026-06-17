@extends('layouts.kasir.app')

@section('title', 'Table Management')

@section('page-title', 'Table Management')

@section('content')



    {{-- Summary Card --}}

    <div class="flex gap-4 mb-8 flex-wrap">

        <div class="bg-white rounded-xl px-5 py-3 shadow-sm border border-gray-100">
            🟢 Available ({{ $availableCount }})
        </div>

        <div class="bg-white rounded-xl px-5 py-3 shadow-sm border border-gray-100">
            🔴 Occupied ({{ $occupiedCount }})
        </div>

        <div class="bg-white rounded-xl px-5 py-3 shadow-sm border border-gray-100">
            🟣 Pending ({{ $pendingCount }})
        </div>

        <div class="bg-white rounded-xl px-5 py-3 shadow-sm border border-gray-100">
            🔵 Kitchen ({{ $kitchenCount }})
        </div>

    </div>

    <div class="flex justify-end mb-6">

        <a href="{{ route('kasir.tables.create') }}"
            class="bg-green-700 hover:bg-green-800 text-white px-5 py-3 rounded-lg">

            + Tambah Meja

        </a>

    </div>

    {{-- Grid Table --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-5">

        @forelse($tables as $table)

            @php

                $occupied = $table->customerSessions
                    ->where('status', 'active')
                    ->isNotEmpty();

            @endphp

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition">

                <div class="flex justify-between items-start">

                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ $table->table_number }}
                    </h2>

                    <span class="text-2xl">
                        🪑
                    </span>

                </div>

                <div class="mt-5">

                    <p class="text-xs uppercase tracking-wider text-gray-400">
                        QR Token
                    </p>

                    <p class="text-xs font-medium text-gray-600 break-all">
                        {{ $table->qr_token }}
                    </p>

                </div>

                <div class="mt-5">

                    @if($occupied)

                        <span class="inline-flex px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                            Occupied
                        </span>

                    @else

                        <span class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                            Available
                        </span>

                    @endif

                </div>

                <div class="mt-6">

                    <a href="{{ route('kasir.tables.show', $table) }}"
                        class="block text-center bg-green-700 hover:bg-green-800 text-white py-2 rounded-lg">
                        Open
                    </a>

                </div>

                <div class="grid grid-cols-2 gap-2 mt-3">

                    <a href="{{ route('kasir.tables.edit', $table->id) }}"
                        class="text-center bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-lg">

                        Edit

                    </a>

                    <form action="{{ route('kasir.tables.destroy', $table->id) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" onclick="return confirm('Hapus meja ini?')"
                            class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg">

                            Hapus

                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="col-span-full bg-white rounded-xl p-6 text-center text-gray-500">

                Belum ada meja

            </div>

        @endforelse


    </div>

@endsection