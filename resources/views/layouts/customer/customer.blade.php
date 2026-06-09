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

    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-gray-100">

    @php
        $cartCount = collect(session('cart', []))
            ->sum('qty');
    @endphp

    <div class="mx-auto">

        <nav class="bg-white sticky top-0 z-50 w-full px-4 py-3 flex items-center justify-between shadow-sm">
            <!-- Left Side -->
            <div class="flex items-center gap-2">

                <!-- Return back -->
                <button onclick="history.back()">
                    <span class="text-lg">←</span>
                </button>

                <!-- Logo -->
                <div class="w-10 h-10 rounded-full overflow-hidden border border-gray-200">
                <img
                    src=""
                    alt="Logo"
                    class="w-full h-full object-cover"
                />
                </div>
            </div>

            <!-- Right Side -->
            <a
                href="{{ route('cart.index') }}"
                class="relative w-10 h-10 rounded-full bg-brand-gradient flex items-center justify-center">
                <!-- Cart Icon -->
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 text-white"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.293 1.293A1 1 0 007 16h12m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                />
                </svg>

                <!-- Badge -->
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-semibold w-4 h-4 rounded-full flex items-center justify-center">
                    {{ $cartCount }}
                </span>
            </a>
        </nav>

        <main class="min-h-screen bg-neutral-100">

            @yield('content')

        </main>
    </div>

</body>
</html>