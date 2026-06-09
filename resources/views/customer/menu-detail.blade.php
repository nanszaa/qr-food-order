@extends('layouts.customer.customer')

@section('title', $menu->name)

@section('content')

<div class="pb-24">

    <img
        src="https://placehold.co/600x400"
        class="w-full h-64 object-cover"
    >

    <div class="p-4">

        <h1 class="text-2xl font-bold">
            {{ $menu->name }}
        </h1>

        <p class="text-gray-500 mt-2">
            {{ $menu->description }}
        </p>

        <p class="text-green-600 font-bold text-xl mt-4">
            Rp {{ number_format($menu->price,0,',','.') }}
        </p>

        <div class="mt-6">

            <label class="block font-medium mb-2">
                Catatan Pesanan
            </label>

           <form
                action="{{ route('cart.add', $menu->menu_id) }}"
                method="POST"
            >

                @csrf

                <textarea
                name="notes"
                rows="4"
                placeholder="Contoh: tanpa gula, pedas level 2"
                class="w-full border rounded-xl p-3"
                ></textarea>

                <label class="block font-medium mb-2">
                    Jumlah
                </label>

                <input
                    type="number"
                    name="qty"
                    value="1"
                    min="1"
                    class="w-full border rounded-xl p-3"
                />

                <button
                    type="submit"
                    class="w-full bg-green-500 text-white py-3 rounded-xl font-semibold"
                >
                    Tambah ke Keranjang
                </button>

            </form>

        </div>

    </div>


</div>

@endsection