@extends('layouts.kasir.app')

@section('title', 'Tambah Kategori')

@section('page-title', 'Tambah Kategori')

@section('content')

<div class="max-w-2xl">

    <div class="bg-white rounded-xl shadow p-6">

        <form
            action="{{ route('kasir.categories.store') }}"
            method="POST"
        >
            @csrf

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="name"
                    required
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500"
                >

            </div>

            <div class="mt-6 flex gap-3">

                <button
                    type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg"
                >
                    Simpan
                </button>

                <a
                    href="{{ route('kasir.categories') }}"
                    class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-lg"
                >
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection