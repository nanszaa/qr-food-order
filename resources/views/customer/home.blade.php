@extends('layouts.customer.customer')

@section('title', 'Menu')

@section('content')

    <div class="min-h-screen bg-brand-50 font-sans">

        {{-- ===== STICKY HEADER ===== --}}
        <div class="sticky top-0 z-30 bg-brand-gradient px-5 pt-5 pb-4 shadow-header">

            {{-- Top bar --}}
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-white text-2xl font-extrabold tracking-tight leading-tight">
                        Warkop KUY
                    </h1>

                </div>

                <p class="bg-brand-300 text-black px-3 py-2 text-xs font-medium mt-0.5 flex items-center gap-1 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    @if($table)
                        Meja {{ $table->table_number }}
                    @else
                        Belum Scan Meja
                    @endif
                </p>
            </div>

            {{-- Search --}}
            <div class="mt-4 relative">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-neutral-hint" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Cari makanan atau minuman..."
                    class="w-full pl-11 pr-4 py-3 rounded-2xl bg-white/95 text-neutral-body placeholder-neutral-hint text-sm outline-none focus:ring-2 focus:ring-brand-300 transition">
            </div>

            {{-- Category chips --}}
            <div class="mt-4 flex gap-2.5 overflow-x-auto scrollbar-hide pb-1">

                <a href="/" class="flex-shrink-0 px-4 py-2 rounded-pill text-sm font-semibold transition-all
                       {{ !$selectedCategory
        ? 'bg-white text-brand-700 shadow-md'
        : 'bg-white/20 text-white/80 hover:bg-white/30'
                       }}">
                    Semua
                </a>

                @foreach($categories as $category)
                        <a href="/?category={{ $category->category_id }}" class="flex-shrink-0 px-4 py-2 rounded-pill text-sm font-semibold transition-all whitespace-nowrap
                                       {{ $selectedCategory == $category->category_id
                    ? 'bg-white text-brand-700 shadow-md'
                    : 'bg-white/20 text-white/80 hover:bg-white/30'
                                       }}">
                            {{ $category->icon }} {{ $category->name }}
                        </a>
                @endforeach

            </div>
        </div>

        {{-- ===== MENU LIST ===== --}}
        <div class="px-4 pt-5 pb-28">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-brand-700 font-bold text-base tracking-wide">
                    Daftar Menu
                </h2>
                <span class="text-xs font-semibold text-brand-600 bg-brand-100 px-3 py-1 rounded-pill">
                    {{ $menus->count() }} menu tersedia
                </span>
            </div>

            {{-- Grid responsif --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3.5">

                @foreach($menus as $menu)
                    <a href="{{ route('menu.show', $menu->menu_id) }}"
                        class="group bg-white rounded-2xl shadow-card hover:shadow-card-hover overflow-hidden border border-card-border transition-all duration-200 active:scale-[0.98] flex flex-col">

                        {{-- Gambar --}}
                        <div class="relative overflow-hidden aspect-[4/3]">
                            <img src="https://placehold.co/400x300/b7e4c7/1b4332?text={{ urlencode($menu->name) }}"
                                alt="{{ $menu->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">

                            @if($menu->is_best_seller)
                                <div class="absolute top-2 left-2 bg-danger text-white text-xs px-2.5 py-1 rounded-lg">
                                    Best Seller
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="p-3 flex flex-col justify-between flex-1">
                            <div>
                                <h3 class="font-bold text-neutral-heading text-sm leading-tight line-clamp-1">
                                    {{ $menu->name }}
                                </h3>
                                <p class="text-xs text-neutral-hint mt-0.5 line-clamp-2 leading-relaxed">
                                    {{ $menu->description }}
                                </p>
                            </div>

                            <div class="flex justify-between items-center mt-3">
                                <span class="font-extrabold text-brand-600 text-sm">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </span>

                                <form action="{{ route('cart.add', $menu->menu_id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        onclick="event.preventDefault(); event.stopPropagation(); this.closest('form').submit();"
                                        class="bg-brand-600 hover:bg-brand-700 active:scale-90 text-white w-9 h-9 rounded-xl text-xl font-light flex items-center justify-center shadow transition-all duration-150">
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