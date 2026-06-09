<!DOCTYPE html>
<html>
<head>
    <title>Daftar Meja</title>
</head>
<body>

<h1>Daftar Meja</h1>

@forelse($tables as $table)

    <hr>

    <p>
        Meja :
        {{ $table->table_number }}
    </p>

    <p>
        QR Token :
        {{ $table->qr_token }}
    </p>

    <p>
        Aktif :
        {{ $table->is_active ? 'Ya' : 'Tidak' }}
    </p>

@empty

    <p>
        Belum ada meja
    </p>

@endforelse

</body>
</html>