<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu</title>
</head>
<body>

<h1>Edit Menu</h1>

<form
    action="{{ route(
        'kasir.menus.update',
        $menu->menu_id
    ) }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf
    @method('PUT')

    <p>Kategori</p>

    <select name="category_id">

        @foreach($categories as $category)

            <option
                value="{{ $category->category_id }}"
                {{ $menu->category_id == $category->category_id ? 'selected' : '' }}
            >
                {{ $category->name }}
            </option>

        @endforeach

    </select>

    <p>Nama Menu</p>

    <input
        type="text"
        name="name"
        value="{{ $menu->name }}"
    >

    <p>Deskripsi</p>

    <textarea name="description">{{ $menu->description }}</textarea>

    <p>Harga</p>

    <input
        type="number"
        name="price"
        value="{{ $menu->price }}"
    >

    <p>Stock</p>

    <input
        type="number"
        name="stock"
        value="{{ $menu->stock }}"
    >

    <p>
        <label>
            <input
                type="checkbox"
                name="is_available"
                {{ $menu->is_available ? 'checked' : '' }}
            >
            Tersedia
        </label>
    </p>

    @if($menu->image)

    <p>Gambar Saat Ini</p>

    <img
        src="{{ asset('storage/'.$menu->image) }}"
        width="150"
    >

    <p>Ganti Gambar</p>

<input
    type="file"
    name="image"
>

@endif

    <button type="submit">
        Update
    </button>

</form>

</body>
</html>