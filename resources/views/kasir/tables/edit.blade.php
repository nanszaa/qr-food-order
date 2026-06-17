@extends('layouts.kasir.app')

@section('title', 'Edit Meja')

@section('page-title', 'Edit Meja')

@section('content')

<div class="max-w-2xl">

    <div class="bg-white rounded-xl shadow p-6">

        <form
            action="{{ route('kasir.tables.update', $table->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div>

                <label class="block text-sm font-medium mb-2">
                    Nomor Meja
                </label>

                <input
                    type="text"
                    name="table_number"
                    value="{{ old('table_number', $table->table_number) }}"
                    class="w-full border rounded-lg px-4 py-3">

            </div>

            <div class="mt-5">

                <label class="flex items-center gap-2">

                    <input
                        type="checkbox"
                        name="is_active"
                        {{ $table->is_active ? 'checked' : '' }}>

                    <span>
                        Meja Aktif
                    </span>

                </label>

            </div>

            <div class="mt-5">

                <label class="block text-sm font-medium mb-2">
                    QR Token
                </label>

                <input
                    type="text"
                    readonly
                    value="{{ $table->qr_token }}"
                    class="w-full bg-gray-100 border rounded-lg px-4 py-3">

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

                    Update Meja

                </button>

            </div>

        </form>

    </div>

</div>

@endsection