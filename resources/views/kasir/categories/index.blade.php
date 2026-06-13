@extends('layouts.kasir.app')

@section('title', 'Kategori')

@section('page-title', 'Daftar Kategori')

@section('content')

   <div class="flex justify-between items-center mb-6">

    <h3 class="text-xl font-semibold">
        Daftar Kategori
    </h3>

    <a
        href="{{ route('kasir.categories.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg"
    >
        + Tambah Kategori
    </a>

</div>

@if(session('success'))

    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>

@endif

<div class="bg-white rounded-xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="text-left p-4">
                    Nama
                </th>

                <th class="text-left p-4">
                    Slug
                </th>

                <th class="text-center p-4">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody>

        @forelse($categories as $category)

            <tr class="border-t">

                <td class="p-4">
                    {{ $category->name }}
                </td>

                <td class="p-4 text-gray-500">
                    {{ $category->slug }}
                </td>

                <td class="p-4">

                    <div class="flex justify-center gap-2">

                        <a
                            href="{{ route(
                                'kasir.categories.edit',
                                $category->category_id
                            ) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route(
                                'kasir.categories.destroy',
                                $category->category_id
                            ) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin hapus kategori ini?')"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded"
                            >
                                Hapus
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="3" class="text-center p-6 text-gray-500">
                    Belum ada kategori
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection

