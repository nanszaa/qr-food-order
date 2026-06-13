@extends('layouts.kasir.app')

@section('title', 'Tambah Menu')

@section('page-title', 'Tambah Menu')

@section('content')

<div class="max-w-3xl">

```
<div class="bg-white rounded-2xl shadow-sm p-6">

    <form
        action="{{ route('kasir.menus.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div class="mb-4">

            <label class="block font-medium mb-2">
                Kategori
            </label>

            <select
                name="category_id"
                class="w-full border rounded-lg px-4 py-3"
            >

                @foreach($categories as $category)

                    <option value="{{ $category->category_id }}">
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
            ></textarea>

        </div>

        <div class="grid md:grid-cols-2 gap-4 mb-4">

            <div>

                <label class="block font-medium mb-2">
                    Harga
                </label>

                <input
                    type="number"
                    name="price"
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
                    class="w-full border rounded-lg px-4 py-3"
                >

            </div>

        </div>

        <div class="mb-4">

            <label class="block font-medium mb-2">
                Gambar Menu
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
                    checked
                >

                Tersedia

            </label>

            <label class="flex items-center gap-2">

                <input
                    type="checkbox"
                    name="is_best_seller"
                >

                Best Seller

            </label>

        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-lg"
            >
                Simpan
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
