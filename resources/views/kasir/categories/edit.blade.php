<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
</head>
<body>

<h1>Edit Kategori</h1>

<form
    action="{{ route(
        'kasir.categories.update',
        $category->category_id
    ) }}"
    method="POST"
>

    @csrf
    @method('PUT')

    <p>
        Nama Kategori
    </p>

    <input
        type="text"
        name="name"
        value="{{ $category->name }}"
    >

    <br><br>

    <button type="submit">
        Update
    </button>

</form>

</body>
</html>