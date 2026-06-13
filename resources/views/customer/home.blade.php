@extends('layouts.customer.customer')

@section('title', 'Menu')

@section('content')

    <div class="min-h-screen bg-brand-bg font-sans">

        {{-- ===== STICKY HEADER ===== --}}
        <div class="border-b border-gray-200">
            <div class="px-4 md:px-6 lg:px-8 py-4">

                <div class="bg-brand-100 text-brand-700 rounded-lg px-3 py-1 text-xs flex items-center gap-1">

                    @if($table)
                        Meja {{ $table->table_number }}
                    @else
                        Belum Scan Meja
                    @endif

                </div>

                <div class="my-6 flex flex-col lg:flex-row gap-3">

                    {{-- ===== SEARCH ===== --}}
                    <div class="relative lg:w-80 w-full">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-neutral-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />

                        </svg>

                        <input type="text" placeholder="Mau makan apa hari ini?"
                            class="w-full border rounded-lg pl-10 pr-4 py-3 outline-none bg-neutral-50 border-neutral-200">

                    </div>
                    {{-- ===== /SEARCH ===== --}}

                    {{-- ===== CATEGORY ===== --}}
                    <div class="flex gap-3 overflow-x-auto pb-1">

                        <a href="/" class="px-5 py-3 rounded-lg text-sm border border-neutral-200
                            {{ !$selectedCategory
                            ? 'bg-brand-700 text-white font-semibold hover:bg-brand-800'
                            : 'bg-neutral-50 text-brand-700 hover:bg-brand-100'}}">
                            All
                        </a>

                        @foreach($categories as $category)

                            <a href="/?category={{ $category->category_id }}" class="px-5 py-3 rounded-lg text-sm whitespace-nowrap border border-neutral-200
                                {{ $selectedCategory == $category->category_id
                                ? 'bg-brand-700 text-white font-semibold hover:bg-brand-800'
                                : 'bg-neutral-50 text-brand-700 hover:bg-brand-100'}}">

                                {{ $category->name }}
                            </a>

                        @endforeach

                    </div>
                    {{-- ===== /CATEGORY ===== --}}
                </div>
            </div>
        </div>

        {{-- ===== MENU COUNT ===== --}}
        <div class="px-4 md:px-6 lg:px-8 py-6">

            <div class="flex justify-between items-center mb-5">

                <h2 class="font-semibold text-xl">
                    Daftar Menu
                </h2>

                <span class="text-xs bg-brand-100 p-2 rounded-lg font-semibold text-brand-600">
                    {{ $menus->count() }} Menu
                </span>

            </div>

            {{-- MENU LIST --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">

                @foreach($menus as $menu)
                    <a href="{{ route('menu.show', $menu->menu_id) }}"
                        class="bg-neutral-100 rounded-xl border border-neutral-200 overflow-hidden hover:shadow-md transition">

                        {{-- Gambar --}}
                        <div class="relative overflow-hidden aspect-[4/3]">
                            <img src="https://placehold.co/400x300/b7e4c7/1b4332?text={{ urlencode($menu->name) }}"
                                alt="{{ $menu->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">

                            @if($menu->is_best_seller)
                                <div class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">
                                    Best Seller
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="p-3 flex flex-col flex-1">

                            <h3 class="font-semibold">
                                {{ $menu->name }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1 line-clamp-1">
                                {{ $menu->description }}
                            </p>

                            <div class="flex justify-between items-center mt-4">

                                <span class="text-brand-700 font-bold">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </span>

                                <form action="{{ route('cart.add', $menu->menu_id) }}" method="POST">
                                    @csrf

                                    <button
                                        onclick="event.preventDefault();event.stopPropagation();this.closest('form').submit();"
                                        class="w-8 h-8 border border-brand-700 rounded-lg text-brand-700 hover:bg-brand-700 hover:text-white transition">

                                        +

                                    </button>

                                </form>

                            </div>

                        </div>
                    </a>
                @endforeach

            </div>

            {{-- Empty state --}}
            @if($menus->isEmpty())
                <div class="text-center py-16">
                    <p class="text-4xl mb-3">🍽️</p>
                    <p class="text-brand-600 font-semibold text-sm">Menu belum tersedia</p>
                    <p class="text-neutral-hint text-xs mt-1">Coba pilih kategori lain</p>
                </div>
            @endif

        </div>

    </div>

@endsection