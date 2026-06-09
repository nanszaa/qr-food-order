<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 border-r border-gray-200 flex flex-col justify-between">
      
        <!-- Top -->
        <div>
            
            <!-- Logo -->
            <div class="h-20 flex items-center justify-center border-b border-gray-200">
            <img
                src="https://via.placeholder.com/40"
                alt="Logo"
                class="w-10 h-10 object-cover"
            />
            </div>

            <!-- Menu -->
            <nav class="mt-2 flex flex-col">
            
            <!-- Active -->
            <a
                href="#"
                class="bg-lime-500 text-white text-sm px-4 py-3"
            >
                Daftar Pesanan
            </a>

            <!-- Normal -->
            <a
                href="#"
                class="text-gray-700 text-sm px-4 py-3 hover:bg-gray-100 transition"
            >
                Daftar Menu
            </a>

            <a
                href="#"
                class="text-gray-700 text-sm px-4 py-3 hover:bg-gray-100 transition"
            >
                Daftar Meja
            </a>
            </nav>
        </div>

        <!-- Bottom User -->
        <div class="border-t border-gray-200 p-4 flex items-center gap-2">
            <div class="w-5 h-5 rounded-full bg-gray-300"></div>
            <span class="text-sm text-gray-700">Kasir</span>
        </div>
    </aside>

    <!-- Content -->
    <main class="flex-1 bg-[#f5f5f5] p-6">
      <div class="w-full h-full rounded bg-white border border-gray-200">
        <!-- Content Here -->
      </div>
    </main>

</body>
</html>