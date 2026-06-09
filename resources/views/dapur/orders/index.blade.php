<!DOCTYPE html>
<html>
<head>
    <title>Pesanan Dapur</title>
</head>
<body>

<h1>Pesanan Dapur</h1>

@if(session('success'))

    <p>
        {{ session('success') }}
    </p>

@endif

<hr>

<h3>Ringkasan Dapur</h3>

<p>
    Pending :
    {{ $pendingCount }}
</p>

<p>
    Cooking :
    {{ $cookingCount }}
</p>

<p>
    Ready :
    {{ $readyCount }}
</p>

<p>
    Served :
    {{ $servedCount }}
</p>

<hr>

<h3>Filter Status</h3>

<a href="{{ route('dapur.orders') }}">
    Semua
</a>

|

<a href="{{ route('dapur.orders', ['status' => 'pending']) }}">
    Pending
</a>

|

<a href="{{ route('dapur.orders', ['status' => 'cooking']) }}">
    Cooking
</a>

|

<a href="{{ route('dapur.orders', ['status' => 'ready']) }}">
    Ready
</a>

|

<a href="{{ route('dapur.orders', ['status' => 'served']) }}">
    Served
</a>

<hr>

@forelse($items as $item)

    <hr>

    <p>
        Order :
        {{ $item->order->order_code }}
    </p>

    <p>
        Meja :
        {{ $item->order->customerSession->table->table_number }}
    </p>

    <p>
        Menu :
        {{ $item->menu->name }}
    </p>

    <p>
        Qty :
        {{ $item->quantity }}
    </p>

    <p>
        Status :
        {{ $item->kitchen_status }}
    </p>

    <form
        action="{{ route(
            'dapur.orders.update-status',
            $item->order_item_id
        ) }}"
        method="POST"
    >
        @csrf

        <select name="kitchen_status">

            <option
                value="pending"
                {{ $item->kitchen_status == 'pending' ? 'selected' : '' }}
            >
                Pending
            </option>

            <option
                value="cooking"
                {{ $item->kitchen_status == 'cooking' ? 'selected' : '' }}
            >
                Cooking
            </option>

            <option
                value="ready"
                {{ $item->kitchen_status == 'ready' ? 'selected' : '' }}
            >
                Ready
            </option>

            <option
                value="served"
                {{ $item->kitchen_status == 'served' ? 'selected' : '' }}
            >
                Served
            </option>

        </select>

        <button type="submit">
            Update Status
        </button>

    </form>

@empty

    <p>
        Tidak ada pesanan dapur
    </p>

@endforelse

</body>
</html>