@extends('layouts.customer.customer')

@section('title', $menu->name)

@section('content')

<div class="min-h-screen bg-brand-50 font-sans pb-10">

    {{-- ===== HERO IMAGE ===== --}}
    <div class="relative">
        <img
            src="https://placehold.co/600x400/b7e4c7/1b4332?text={{ urlencode($menu->name) }}"
            alt="{{ $menu->name }}"
            class="w-full h-64 object-cover"
            
        >

        {{-- Back button --}}
        <a
            href="javascript:history.back()"
            class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-brand-700 w-9 h-9 rounded-xl flex items-center justify-center shadow-card hover:bg-white transition"
        >
            ←
        </a>

        @if($menu->is_best_seller)
        <div class="absolute top-4 right-4 bg-danger text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow">
            🔥 Best Seller
        </div>
        @endif
    </div>

    {{-- ===== CONTENT CARD ===== --}}
    <div class="relative -mt-5 bg-brand-50 rounded-t-3xl px-5 pt-6">

        {{-- Nama & kategori --}}
        <div class="flex justify-between items-start mb-1">
            <h1 class="text-neutral-heading text-xl font-extrabold leading-tight flex-1 pr-3">
                {{ $menu->name }}
            </h1>
            @if($menu->category)
            <span class="flex-shrink-0 bg-brand-100 text-brand-600 text-xs font-semibold px-3 py-1 rounded-pill mt-1">
                {{ $menu->category->icon ?? '' }} {{ $menu->category->name }}
            </span>
            @endif
        </div>

        <p class="text-neutral-muted text-sm mt-2 leading-relaxed">
            {{ $menu->description }}
        </p>

        <p class="text-brand-600 font-extrabold text-2xl mt-4">
            Rp {{ number_format($menu->price, 0, ',', '.') }}
        </p>

        {{-- Divider --}}
        <div class="border-t border-card-border mt-5 mb-5"></div>

        {{-- ===== FORM ===== --}}
        <form action="{{ route('cart.add', $menu->menu_id) }}" method="POST">
            @csrf

            {{-- Catatan --}}
            <div class="mb-5">
                <label class="block text-neutral-heading text-sm font-bold mb-2">
                    Catatan Pesanan
                </label>
                <textarea
                    name="notes"
                    rows="3"
                    placeholder="Contoh: tanpa gula, pedas level 2..."
                    class="w-full border border-card-border bg-white rounded-2xl px-4 py-3 text-sm text-neutral-body placeholder-neutral-hint outline-none focus:ring-2 focus:ring-brand-300 focus:border-transparent transition resize-none"
                ></textarea>
            </div>

            {{-- Jumlah --}}
            <div class="mb-6">
                <label class="block text-neutral-heading text-sm font-bold mb-3">
                    Jumlah
                </label>

                <div class="flex items-center gap-4">
                    <button
                        type="button"
                        onclick="decreaseQty()"
                        class="w-11 h-11 bg-danger text-white rounded-xl text-xl font-bold flex items-center justify-center hover:bg-danger-dark active:scale-90 transition-all"
                    >
                        −
                    </button>

                    <input
                        type="number"
                        id="qty"
                        name="qty"
                        value="1"
                        min="1"
                        oninput="updateTotal()"
                        class="w-16 text-center border border-card-border bg-white rounded-xl py-2.5 text-base font-bold text-neutral-heading outline-none focus:ring-2 focus:ring-brand-300 transition"
                    >

                    <button
                        type="button"
                        onclick="increaseQty()"
                        class="w-11 h-11 bg-brand-600 text-white rounded-xl text-xl font-bold flex items-center justify-center hover:bg-brand-700 active:scale-90 transition-all"
                    >
                        +
                    </button>

                    <div class="ml-auto text-right">
                        <p class="text-xs text-neutral-hint">Total</p>
                        <p id="total-price" class="text-brand-600 font-extrabold text-base">
                            Rp {{ number_format($menu->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full bg-brand-gradient text-white py-4 rounded-2xl font-bold text-sm shadow-card-hover hover:opacity-90 active:scale-[0.98] transition-all"
            >
                + Tambah ke Keranjang
            </button>

        </form>

    </div>
</div>

<script>
    const price = Number("{{ $menu->price }}");

    function decreaseQty() {
        const input = document.getElementById('qty');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
        updateTotal();
    }

    function increaseQty() {
        const input = document.getElementById('qty');
        input.value = parseInt(input.value) + 1;
        updateTotal();
    }

    function updateTotal() {
        const qty = parseInt(document.getElementById('qty').value) || 1;
        const formatted = new Intl.NumberFormat('id-ID').format(price * qty);
        document.getElementById('total-price').textContent = 'Rp ' + formatted;
    }
</script>

@endsection