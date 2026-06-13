@extends('layouts.customer.customer')

@section('title', $menu->name)

@section('content')

<div class="min-h-screen bg-brand-bg py-6">


    {{-- ===== HERO IMAGE ===== --}}
    <div class="relative">
        <img
            src="https://placehold.co/600x400/b7e4c7/1b4332?text={{ urlencode($menu->name) }}"
            alt="{{ $menu->name }}"
            class="w-full h-64 object-cover"
            
        >

    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <form action="{{ route('cart.add', $menu->menu_id) }}" method="POST">
            @csrf

            <div class="flex flex-col lg:flex-row gap-8">

                {{-- IMAGE --}}
                <div class="w-full lg:w-[380px] flex-shrink-0">

                    <div class="bg-gray-200 overflow-hidden aspect-square rounded-lg">

                        <img
                            src="https://placehold.co/600x600/b7e4c7/1b4332?text={{ urlencode($menu->name) }}"
                            alt="{{ $menu->name }}"
                            class="w-full h-full object-cover">

                    </div>

                </div>

                {{-- RIGHT CONTENT --}}
                <div class="flex-1">

                    <h1 class="text-2xl font-semibold text-black">
                        {{ $menu->name }}
                    </h1>

                    <p class="mt-2 text-brand-700 font-bold text-xl">
                        Rp {{ number_format($menu->price,0,',','.') }}
                    </p>

                    <p class="mt-3 text-neutral-500 leading-relaxed">
                        {{ $menu->description }}
                    </p>

                    <hr class="my-6">

                    {{-- CATATAN --}}
                    <div>

                        <label class="block font-medium mb-2">

                            Catatan Pesanan

                        </label>

                        <textarea
                            name="notes"
                            rows="4"
                            placeholder="Contoh: tanpa gula, pedas level 2"
                            class="w-full bg-neutral-50 border border-neutral-200 rounded-lg p-3 resize-none outline-none focus:ring focus:ring-brand-200"></textarea>

                    </div>

                    {{-- JUMLAH --}}
                    <div class="mt-6">

                        <label class="block font-medium mb-2">

                            Jumlah Pesanan

                        </label>

                        <div class="inline-flex items-center bg-neutral-50 border border-neutral-200 rounded overflow-hidden">

                            <button
                                type="button"
                                onclick="decreaseQty()"
                                class="w-8 h-8 flex items-center justify-center bg-transparent">

                                -

                            </button>

                            <div class="w-px self-stretch bg-neutral-200"></div>

                            <input
                                id="qty"
                                name="qty"
                                type="number"
                                min="1"
                                value="1"
                                oninput="updateTotal()"
                                class="w-8 text-center bg-transparent border-none outline-none focus:ring-0 appearance-none [-moz-appearance:textfield]">

                            <div class="w-px self-stretch bg-neutral-200"></div>
                            
                            <button
                                type="button"
                                onclick="increaseQty()"
                                class="w-8 h-8 flex items-center justify-center bg-transparent">

                                +

                            </button>

                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div class="mt-8">

                        <button
                            type="submit"
                            class="w-full bg-brand-700 hover:bg-brand-800 text-white py-3 rounded-lg font-medium transition">

                            Tambahkan ke keranjang

                        </button>

                    </div>

                </div>

            </div>

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