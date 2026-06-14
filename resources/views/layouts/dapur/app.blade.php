<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen overflow-hidden bg-brand-bg font-sans">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-white flex flex-col justify-between flex-shrink-0">

            <!-- Top -->
            <div>

                <!-- Logo -->
                <div class="px-6 py-5 border-b flex items-center gap-3">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        class="w-12 h-12 rounded-full">

                    <div>
                        <h1 class="font-bold text-gray-700">
                            Warung KUY
                        </h1>

                        <p class="text-xs text-gray-400">
                            Kitchen HUB
                        </p>
                    </div>

                </div>

                <!-- Menu -->
                <nav class="p-4">

                    <a
                        href="{{ route('dapur.orders.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl
                        {{ request()->routeIs('dapur.orders.index')
                            ? 'bg-brand-600 text-white'
                            : 'text-gray-700 hover:bg-gray-100 transition' }}">

                        <span>📋</span>

                        <span class="font-medium">
                            Orders
                        </span>

                    </a>

                </nav>

            </div>

            <!-- Bottom -->
            <div class="border-t p-4 flex justify-between items-center">

                <div class="flex items-center gap-3">

                    <div
                        class="w-10 h-10 rounded-full bg-brand-600 text-white flex items-center justify-center font-bold">

                        D

                    </div>

                    <div>

                        <p class="font-medium">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Kitchen Staff
                        </p>

                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="text-danger font-medium">
                        Logout
                    </button>
                </form>

            </div>

        </aside>

        <!-- Content -->
        <main class="flex-1 h-screen overflow-hidden bg-brand-bg">

            @yield('content')

        </main>

    </div>

</body>

</html>