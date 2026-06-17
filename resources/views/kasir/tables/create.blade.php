@extends('layouts.kasir.app')

@section('title', 'Tambah Meja')

@section('page-title', 'Tambah Meja')

@section('content')

<div class="max-w-2xl">

    <div class="bg-white rounded-xl shadow p-6">

        <form
            action="{{ route('kasir.tables.store') }}"
            method="POST">

            @csrf

            <div>

                <label class="block text-sm font-medium mb-2">
                    Nomor Meja
                </label>

                <input
                    type="text"
                    name="table_number"
                    value="{{ old('table_number') }}"
                    placeholder="Contoh: Meja 01"
                    class="w-full border rounded-lg px-4 py-3">

                @error('table_number')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div class="flex gap-3 mt-6">

                <a
                    href="{{ route('kasir.tables') }}"
                    class="px-5 py-3 rounded-lg border">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-5 py-3 bg-green-700 text-white rounded-lg hover:bg-green-800">

                    Simpan Meja

                </button>

            </div>

        </form>

    </div>

</div>

@endsection