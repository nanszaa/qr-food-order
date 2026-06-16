<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script
        type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap"
        rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">

    @php
        $cartCount = collect(session('cart', []))->sum('qty');
    @endphp

    {{-- NAVBAR --}}
    <header
        class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 shadow-sm">

        <div class="max-w-7xl mx-auto px-4 lg:px-6">

            <div class="h-16 flex items-center justify-between">

                {{-- LEFT --}}
                <div class="flex items-center gap-4">

                    @if(!request()->routeIs('home'))
                        <a
                            href="{{ url()->previous() }}"
                            class="text-xl text-gray-600 hover:text-brand-700">
                            ←
                        </a>
                    @endif

                    <a
                        href="{{ route('home') }}"
                        class="flex items-center gap-3">

                        <img
                            src="{{ asset('images/logo.jpg') }}"
                            alt="Logo"
                            class="w-10 h-10 rounded-full object-cover shadow">

                        <div>

                            <h1 class="font-bold text-brand-700 leading-none">
                                Warkop KUY
                            </h1>

                            <p class="text-xs text-gray-500">
                                QR Food Ordering
                            </p>

                        </div>

                    </a>

                </div>

                {{-- RIGHT --}}
                <a
                    href="{{ route('cart.index') }}"
                    class="relative w-11 h-11 rounded-full bg-brand-700 hover:bg-brand-800 transition flex items-center justify-center">

                    {{-- Cart Icon --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-white"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.293 1.293A1 1 0 007 16h12m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />

                    </svg>

                    {{-- Badge --}}
                    @if($cartCount > 0)
                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-semibold min-w-[18px] h-[18px] rounded-full flex items-center justify-center px-1">
                            {{ $cartCount }}
                        </span>
                    @endif

                </a>

            </div>

        </div>

    </header>

    {{-- CONTENT --}}
    <main class="pt-16 min-h-screen bg-neutral-100">

        @yield('content')

    </main>

</body>

</html>