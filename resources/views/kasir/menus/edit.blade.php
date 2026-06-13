@extends('layouts.kasir.app')

@section('title', 'Edit Menu')

@section('page-title', 'Edit Menu')

@section('content')

<div class="max-w-3xl">

```
<div class="bg-white rounded-2xl shadow-sm p-6">

    <form
        action="{{ route('kasir.menus.update', $menu->menu_id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block font-medium mb-2">
                Kategori
            </label>

            <select
                name="category_id"
                class="w-full border rounded-lg px-4 py-3"
            >

                @foreach($categories as $category)

                    <option
                        value="{{ $category->category_id }}"
                        {{ $menu->category_id == $category->category_id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block font-medium mb-2">
                Nama Menu
            </label>

            <input
                type="text"
                name="name"
                value="{{ $menu->name }}"
                class="w-full border rounded-lg px-4 py-3"
            >

        </div>

        <div class="mb-4">

            <label class="block font-medium mb-2">
                Deskripsi
            </label>

            <textarea
                name="description"
                rows="4"
                class="w-full border rounded-lg px-4 py-3"
            >{{ $menu->description }}</textarea>

        </div>

        <div class="grid md:grid-cols-2 gap-4 mb-4">

            <div>

                <label class="block font-medium mb-2">
                    Harga
                </label>

                <input
                    type="number"
                    name="price"
                    value="{{ $menu->price }}"
                    class="w-full border rounded-lg px-4 py-3"
                >

            </div>

            <div>

                <label class="block font-medium mb-2">
                    Stock
                </label>

                <input
                    type="number"
                    name="stock"
                    value="{{ $menu->stock }}"
                    class="w-full border rounded-lg px-4 py-3"
                >

            </div>

        </div>

        @if($menu->image)

            <div class="mb-4">

                <label class="block font-medium mb-2">
                    Gambar Saat Ini
                </label>

                <img
                    src="{{ asset('storage/'.$menu->image) }}"
                    class="w-48 rounded-lg border"
                >

            </div>

        @endif

        <div class="mb-4">

            <label class="block font-medium mb-2">
                Ganti Gambar
            </label>

            <input
                type="file"
                name="image"
                class="w-full border rounded-lg px-4 py-3"
            >

        </div>

        <div class="space-y-2 mb-6">

            <label class="flex items-center gap-2">

                <input
                    type="checkbox"
                    name="is_available"
                    {{ $menu->is_available ? 'checked' : '' }}
                >

                Tersedia

            </label>

            <label class="flex items-center gap-2">

                <input
                    type="checkbox"
                    name="is_best_seller"
                    {{ $menu->is_best_seller ? 'checked' : '' }}
                >

                Best Seller

            </label>

        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg"
            >
                Update
            </button>

            <a
                href="{{ route('kasir.menus') }}"
                class="bg-gray-200 px-6 py-3 rounded-lg"
            >
                Batal
            </a>

        </div>

    </form>

</div>
```

</div>

@endsection
