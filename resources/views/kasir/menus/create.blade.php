<!DOCTYPE html>
<html>

<head>
    <title>Tambah Menu</title>
</head>

<body>

    <h1>Tambah Menu</h1>

    @if(session('success'))

        <p>
            {{ session('success') }}
        </p>

    @endif

    <form action="{{ route('kasir.menus.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <p>Kategori</p>

        <select name="category_id">

            @foreach($categories as $category)

                <option value="{{ $category->category_id }}">
                    {{ $category->name }}
                </option>

            @endforeach

        </select>

        <p>Nama Menu</p>

        <input type="text" name="name">

        <p>Deskripsi</p>

        <textarea name="description"></textarea>

        <p>Harga</p>

        <input type="number" name="price">

        <p>Stock</p>

        <input type="number" name="stock">

        <p>
            <label>
                <input type="checkbox" name="is_available" checked>

                Tersedia
            </label>
        </p>

        <p>Gambar Menu</p>

        <input type="file" name="image">
        <button type="submit">
            Simpan
        </button>

    </form>

</body>

</html>