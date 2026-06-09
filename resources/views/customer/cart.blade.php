@extends('layouts.customer.customer')

@section('title', 'Keranjang')

@section('content')


@if(session('success'))

    <div
        id="success-alert"
        class="bg-green-100 text-green-700 p-3 rounded-xl mb-4 flex items-center justify-between"
    >
        <span>
            {{ session('success') }}
        </span>

        <button
            onclick="document.getElementById('success-alert').remove()"
            class="ml-4 text-green-700 hover:text-green-900 font-bold"
        >
            ✕
        </button>
    </div>

@endif

<div class="p-4">

    <h1 class="text-2xl font-bold mb-6">
        Keranjang Saya
    </h1>

    @forelse($cart as $item)

        <div class="bg-white rounded-2xl shadow-lg p-4 mb-4">

            <h3 class="font-bold">
                {{ $item['name'] }}
            </h3>

            @if(!empty($item['notes']))

                <p class="text-xs text-gray-500 mt-1">
                    Catatan: {{ $item['notes'] }}
                </p>

            @endif

            <p class="text-gray-500 mt-1">
                Rp {{ number_format($item['price'],0,',','.') }}
            </p>

            <div class="mt-3 flex justify-between">

               <div class="flex items-center gap-2">

                    <form
                        action="{{ route('cart.decrease', $item['menu_id']) }}"
                        method="POST"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="w-8 h-8 bg-red-500 text-white rounded-lg"
                        >
                            -
                        </button>

                    </form>

                    <span class="font-semibold">
                        {{ $item['qty'] }}
                    </span>

                    <form
                        action="{{ route('cart.increase', $item['menu_id']) }}"
                        method="POST"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="w-8 h-8 bg-green-500 text-white rounded-lg"
                        >
                            +
                        </button>

                    </form>

                    
                </div>
                
                <span class="font-semibold text-green-600">
                    Rp {{ number_format($item['price'] * $item['qty'],0,',','.') }}
                </span>
                
            </div>
            <div class="mt-3 text-right">

                <form
                    action="{{ route('cart.remove', $item['menu_id']) }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="text-red-500 text-sm"
                    >
                        Hapus
                    </button>

                </form>

            </div>

        </div>

    @empty

        <div class="text-center py-20">

            <p class="text-gray-400">
                Keranjang masih kosong
            </p>

        </div>

    @endforelse

</div>

    @php

$total = collect($cart)->sum(function ($item) {
    return $item['price'] * $item['qty'];
});

@endphp

@if(count($cart))

<div class="sticky bottom-0 bg-white border-t p-4">

    <div class="flex justify-between mb-3">

        <span class="font-medium">
            Total
        </span>

        <span class="font-bold text-green-600">
            Rp {{ number_format($total,0,',','.') }}
        </span>

    </div>

    <a
        href="{{ route('checkout') }}"
        class="block text-center w-full bg-green-500 text-white py-3 rounded-xl font-semibold"
    >
        Checkout
    </a>

</div>

@endif

@endsection