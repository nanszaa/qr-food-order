<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Kasir</title>
</head>
<body>

    <h1>Dashboard Kasir</h1>

    <p>
        Selamat datang,
        {{ auth()->user()->name }}
    </p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button type="submit">
            Logout
        </button>
    </form>

</body>
</html>