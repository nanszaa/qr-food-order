@extends('layouts.kasir.app')

@section('title', 'Menu Management')

@section('page-title', 'Menu Management')

@section('content')

<div class="flex justify-between items-center mb-8">

<div>

    <h3 class="text-lg font-semibold">
        Daftar Menu
    </h3>

    <p class="text-gray-500 text-sm">
        Kelola semua menu restoran
    </p>

</div>

<a
    href="{{ route('kasir.menus.create') }}"
    class="bg-green-700 hover:bg-green-800 text-white px-5 py-3 rounded-xl font-medium"
>
    + Tambah Menu
</a>


</div>

@if(session('success'))


<div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-6">
    {{ session('success') }}
</div>


@endif

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

@forelse($menus as $menu)


<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    @if($menu->image)

        <img
            src="{{ asset('storage/' . $menu->image) }}"
            class="w-full h-48 object-cover"
        >

    @else

        <div class="h-48 bg-gray-200 flex items-center justify-center">

            Tidak Ada Gambar

        </div>

    @endif

    <div class="p-5">

        <div class="flex justify-between items-start">

            <h3 class="font-bold text-lg">
                {{ $menu->name }}
            </h3>

            @if($menu->is_best_seller)

                <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full">
                    Best Seller
                </span>

            @endif

        </div>

        <p class="text-sm text-gray-500 mt-1">
            {{ $menu->category->name }}
        </p>

        <p class="font-bold text-green-700 text-xl mt-3">
            Rp {{ number_format($menu->price,0,',','.') }}
        </p>

        <div class="mt-3 flex justify-between text-sm">

            <span>
                Stock: {{ $menu->stock }}
            </span>

            @if($menu->is_available)

                <span class="text-green-600 font-medium">
                    Available
                </span>

            @else

                <span class="text-red-600 font-medium">
                    Not Available
                </span>

            @endif

        </div>

        <div class="flex gap-2 mt-5">

            <a
                href="{{ route('kasir.menus.edit', $menu->menu_id) }}"
                class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg"
            >
                Edit
            </a>

            <form
                action="{{ route('kasir.menus.destroy', $menu->menu_id) }}"
                method="POST"
                class="flex-1"
            >
                @csrf
                @method('DELETE')

                <button
                    onclick="return confirm('Yakin hapus menu ini?')"
                    class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg"
                >
                    Hapus
                </button>

            </form>

        </div>

    </div>

</div>

@empty


<div class="col-span-full bg-white p-8 rounded-xl text-center">

    Belum ada menu

</div>

@endforelse

</div>

@endsection
