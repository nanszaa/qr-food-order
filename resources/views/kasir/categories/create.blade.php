<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
</head>
<body>

<h1>Tambah Kategori</h1>

<form
    action="{{ route('kasir.categories.store') }}"
    method="POST"
>

    @csrf

    <p>
        Nama Kategori
    </p>

    <input
        type="text"
        name="name"
    >

    <br><br>

    <button type="submit">
        Simpan
    </button>

</form>

</body>
</html>