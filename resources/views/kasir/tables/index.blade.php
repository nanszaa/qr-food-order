<!DOCTYPE html>
<html>

<head>
    <title>Daftar Meja</title>
</head>

<body>



    <h1>Daftar Meja</h1>

    <h2>Ringkasan Meja</h2>

    <p>
        Total Meja :
        {{ $tables->count() }}
    </p>

    <p>
        Occupied :
        {{ $occupiedCount }}
    </p>

    <p>
        Available :
        {{ $availableCount }}
    </p>

    <hr>

    @forelse($tables as $table)

        @php

            $occupied = false;

            foreach ($table->customerSessions as $session) {

                foreach ($session->orders as $order) {

                    if (
                        in_array(
                            $order->order_status,
                            ['pending', 'processing']
                        )
                    ) {
                        $occupied = true;
                    }
                }
            }

        @endphp

        <hr>

        <p>
            Meja :
            {{ $table->table_number }}
        </p>

        <p>
            Status :

            @if($occupied)

                Occupied

            @else

                Available

            @endif
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