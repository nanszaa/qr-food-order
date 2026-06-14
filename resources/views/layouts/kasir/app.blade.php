<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body class="bg-[#f5f5f2]">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside
    class="w-64 h-screen sticky top-0
    flex flex-col
    bg-white border-r border-gray-200"
>

           <div class="p-5 border-b border-gray-200">

    <h1 class="text-xl font-bold text-green-700">
        QR Food Order
    </h1>

    <p class="text-sm text-gray-500">
        Kasir Panel
    </p>

</div>

            <nav class="px-4 py-4 space-y-2 flex-1 overflow-y-auto">

                <a href="{{ route('kasir.dashboard') }}" class="block px-4 py-2 rounded
   {{ request()->routeIs('kasir.dashboard')
    ? 'bg-green-600 text-white'
    : 'hover:bg-slate-800'
   }}">📊 Dashboard</a>

                <a href="{{ route('kasir.tables') }}" class="block px-4 py-2 rounded
   {{ request()->routeIs('kasir.tables*')
    ? 'bg-green-600 text-white'
    : 'hover:bg-slate-800'
   }}">
                    🪑 Meja
                </a>

                <a href="{{ route('kasir.orders') }}" class="block px-4 py-2 rounded
   {{
    request()->routeIs('kasir.orders')
    || request()->routeIs('kasir.orders.show')
    || request()->routeIs('kasir.orders.update-status')
    ? 'bg-green-600 text-white'
    : 'hover:bg-slate-800'
   }}">
                    🧾 Pesanan
                </a>

                <a href="{{ route('kasir.categories') }}" class="block px-4 py-2 rounded
   {{ request()->routeIs('kasir.categories*')
    ? 'bg-green-600 text-white'
    : 'hover:bg-slate-800'
   }}">
                    📂 Kategori
                </a>

                <a href="{{ route('kasir.menus') }}" class="block px-4 py-2 rounded
   {{ request()->routeIs('kasir.menus*')
    ? 'bg-green-600 text-white'
    : 'hover:bg-slate-800'
   }}">
                    🍔 Menu
                </a>

                <a href="{{ route('kasir.reports') }}" class="block px-4 py-2 rounded
   {{ request()->routeIs('kasir.reports*')
    ? 'bg-green-600 text-white'
    : 'hover:bg-slate-800'
   }}">
                    💰 Laporan
                </a>

                <a href="{{ route('kasir.orders.history') }}" class="block px-4 py-2 rounded
   {{
    request()->routeIs('kasir.orders.history')
    ? 'bg-green-600 text-white'
    : 'hover:bg-slate-800'
   }}">
                    📜 Riwayat
                </a>

            </nav>

            <div class="mt-auto p-4 border-t border-gray-200">

    <div class="bg-gray-100 rounded-xl p-3 mb-3">

        <p class="text-xs text-gray-500">
            Role
        </p>

        <p class="font-semibold text-gray-800">
            Kasir
        </p>

    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button
            class="w-full bg-red-100
                   text-red-600
                   py-3
                   rounded-xl
                   font-medium
                   hover:bg-red-200
                   transition"
        >
            Logout
        </button>
    </form>

</div>

        </aside>

        <!-- CONTENT -->
        <main class="flex-1">

            <!-- HEADER -->
            <div class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">

                <h2 class="text-3xl font-bold text-gray-800">
                    @yield('page-title')
                </h2>

                <div class="flex items-center gap-4">

                    <input type="text" placeholder="Search..."
                        class="bg-gray-100 px-4 py-2 rounded-xl w-64 outline-none">

                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                        🔔
                    </div>

                    <div class="w-10 h-10 rounded-full bg-green-200 flex items-center justify-center">
                        👤
                    </div>

                </div>

            </div>

            <!-- PAGE CONTENT -->
            <div class="p-8">

                @yield('content')

            </div>

        </main>
        ```

    </div>

</body>

</html>