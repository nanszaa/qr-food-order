<!DOCTYPE html>
<html>

<head>
    <title>Daftar Menu</title>
</head>

<body>

    <h1>Daftar Menu</h1>

    @if(session('success'))

        <p>
            {{ session('success') }}
        </p>

    @endif

    <p>
        <a href="{{ route('kasir.menus.create') }}">
            Tambah Menu
        </a>
    </p>

    @forelse($menus as $menu)

        <hr>

        <p>
            Nama :
            {{ $menu->name }}
        </p>

        @if($menu->image)

            <img src="{{ asset('storage/' . $menu->image) }}" width="120">

        @endif   

        <p>
            Kategori :
            {{ $menu->category->name }}
        </p>

        <p>
            Harga :
            Rp {{ number_format($menu->price, 0, ',', '.') }}
        </p>

        <p>
            Stock :
            {{ $menu->stock }}
        </p>

        <p>
            Available :
            {{ $menu->is_available ? 'Ya' : 'Tidak' }}
        </p>

        <p>
            <a href="{{ route(
            'kasir.menus.edit',
            $menu->menu_id
        ) }}">
                Edit
            </a>
        </p>


        <form action="{{ route(
            'kasir.menus.destroy',
            $menu->menu_id
        ) }}" method="POST">

            @csrf
            @method('DELETE')

            <button type="submit" onclick="return confirm(
                    'Yakin hapus menu ini?'
                )">
                Hapus
            </button>

        </form>

    @empty

        <p>
            Belum ada menu
        </p>

    @endforelse

</body>

</html>