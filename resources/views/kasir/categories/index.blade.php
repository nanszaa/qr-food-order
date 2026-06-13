<!DOCTYPE html>
<html>

<head>
    <title>Daftar Kategori</title>
</head>

<body>

    <h1>Daftar Kategori</h1>

    <p>
        <a href="{{ route('kasir.categories.create') }}">
            Tambah Kategori
        </a>
    </p>


    @if(session('success'))

        <p>
            {{ session('success') }}
        </p>

    @endif
    @forelse($categories as $category)

        <hr>

        <p>
            Nama :
            {{ $category->name }}
        </p>

        <p>
            Slug :
            {{ $category->slug }}
        </p>

        <p>
            <a href="{{ route(
            'kasir.categories.edit',
            $category->category_id
        ) }}">
                Edit
            </a>
        </p>

        <form action="{{ route(
            'kasir.categories.destroy',
            $category->category_id
        ) }}" method="POST">

            @csrf
            @method('DELETE')

            <button type="submit" onclick="return confirm(
                    'Yakin hapus kategori ini?'
                )">
                Hapus
            </button>

        </form>

    @empty

        <p>
            Belum ada kategori
        </p>

    @endforelse

</body>

</html>