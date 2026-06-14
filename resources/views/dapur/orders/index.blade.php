@extends('layouts.dapur.app')

@section('title', 'Daftar Order')

@section('content')

    <div class="h-full p-6 flex flex-col">

        <h1 class="text-2xl font-bold mb-5">
            Daftar Order
        </h1>

        <div class="grid grid-cols-3 gap-4 flex-1 overflow-hidden">

            {{-- Paid ORDERS --}}
            <div class="bg-gray-100 rounded-xl p-3 flex flex-col h-full overflow-hidden">

                <div class="flex justify-between items-center mb-3">

                    <div class="font-medium flex gap-2 items-center">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <span>Pesanan Baru</span>
                    </div>

                    <span class="text-xs font-medium text-brand-700">
                        {{ $pendingOrders->count() }} orders
                    </span>

                </div>

                <div class="flex-1 overflow-y-auto pr-1">
                    @foreach($pendingOrders as $order)
    
                        <div class="bg-white rounded-xl p-4 shadow mb-3">
    
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="font-bold text-2xl">
                                        {{ $order->customerSession->table->table_number }}
                                    </h3>
        
                                    <span class="font-medium text-neutral-500 text-sm">
                                        {{ $order->order_code }}
                                    </span>
                                </div>

                                <div class="text-sm font-medium flex flex-col items-end">
                                    <span class="text-neutral-500">Elapsed</span>
                                    <div
                                        class="elapsed-time text-danger"
                                        data-created="{{ $order->created_at->timestamp }}">
                                        00:00
                                    </div>
                                </div>
                            </div>
    
                            <hr class="my-3">
    
                            <div>
                                @foreach($order->orderItems as $item)
                                    <div>
                                        <span class="text-brand-700 font-medium">{{ $item->quantity }}x</span> {{ $item->menu->name }}
                                    </div>
                                @endforeach
                            </div>
    
                            <hr class="my-3">
    
                            <form action="{{ route('dapur.orders.start', $order->order_id) }}" method="POST">
                                @csrf
                                <button class="w-full bg-blue-500 text-white rounded-lg py-3">
                                    Mulai Masak
                                </button>
                            </form>
                        </div>
    
                    @endforeach
                </div>
            </div>

            {{-- Cooking --}}
            <div class="bg-gray-100 rounded-xl p-3 flex flex-col h-full overflow-hidden">

                <div class="flex justify-between items-center mb-3">

                    <div class="font-medium flex gap-2 items-center">
                        <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                        <span>Sedang Dimasak</span>
                    </div>

                    <span class="text-xs font-medium text-brand-700">
                        {{ $cookingOrders->count() }} orders
                    </span>

                </div>

                <div class="flex-1 overflow-y-auto pr-1">
                    @foreach($cookingOrders as $order)
    
                        <div class="bg-white rounded-xl p-4 shadow mb-3">
    
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="font-bold text-2xl">
                                        {{ $order->customerSession->table->table_number }}
                                    </h3>
        
                                    <span class="font-medium text-neutral-500 text-sm">
                                        {{ $order->order_code }}
                                    </span>
                                </div>

                                <div class="text-sm font-medium flex flex-col items-end">
                                    <span class="text-neutral-500">Elapsed</span>
                                    <div
                                        class="elapsed-time text-danger"
                                        data-created="{{ $order->created_at->timestamp }}">
                                        00:00
                                    </div>
                                </div>
                            </div>
    
                            <hr class="my-3">
    
                            @foreach($order->orderItems as $item)
    
                                <form action="{{ route('dapur.orders.update-status', $item->order_item_id) }}" method="POST"
                                    class="mb-2">
    
                                    @csrf
    
                                    <input type="hidden" name="kitchen_status" value="ready">
    
                                    <button
                                        class="w-full text-left flex justify-between items-center border rounded-lg px-3 py-2 hover:bg-gray-50">
    
                                        <span>
                                            <span class="font-medium text-brand-700">
                                                {{ $item->quantity }}x
                                            </span>
    
                                            {{ $item->menu->name }}
                                        </span>
    
                                        @if($item->kitchen_status == 'ready')
    
                                            <div class="border border-brand-700 bg-brand-700 w-4 h-4 text-xs items-center flex justify-center text-white">
                                                ✔
                                            </div>
    
                                        @else
    
                                            <div class="border border-neutral-500 w-4 h-4"></div>
    
                                        @endif
    
                                    </button>
    
                                </form>
    
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Ready --}}
            <div class="bg-gray-100 rounded-xl p-3 flex flex-col h-full overflow-hidden">

                <div class="flex justify-between items-center mb-3">

                    <div class="font-medium flex gap-2 items-center">
                        <div class="w-2 h-2 bg-brand-500 rounded-full"></div>
                        <span>Siap Diantar</span>
                    </div>

                    <span class="text-xs font-medium text-brand-700">
                        {{ $readyOrders->count() }} orders
                    </span>

                </div>

                <div class="flex-1 overflow-y-auto pr-1">
                    @foreach($readyOrders as $order)
    
                        <div class="bg-white rounded-xl p-4 shadow mb-3">
    
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="font-bold text-2xl">
                                        {{ $order->customerSession->table->table_number }}
                                    </h3>
        
                                    <span class="font-medium text-neutral-500 text-sm">
                                        {{ $order->order_code }}
                                    </span>
                                </div>

                                <div class="text-sm font-medium flex flex-col items-end">
                                    <span class="text-neutral-500">Elapsed</span>
                                    <div
                                        class="elapsed-time text-danger"
                                        data-created="{{ $order->created_at->timestamp }}">
                                        00:00
                                    </div>
                                </div>
                            </div>
    
                            <hr class="my-3">
    
                            @foreach($order->orderItems as $item)
    
                                <div>
                                    <span class="font-medium text-brand-700">
                                        {{ $item->quantity }}x
                                    </span>
    
                                    {{ $item->menu->name }}
                                </div>
    
                            @endforeach
    
                            <hr class="my-3">
    
                            <form action="{{ route('dapur.orders.served', $order->order_id) }}" method="POST">
    
                                @csrf
    
                                <button class="w-full bg-brand-600 text-white rounded-lg py-3 font-medium">
    
                                    Siap Diantar
    
                                </button>
    
                            </form>
    
                        </div>
    
                    @endforeach
                </div>
            </div>
        </div>
    </div>

<script>
    setInterval(() => {

        document.querySelectorAll(".elapsed-time")
            .forEach(el => {

                const created =
                    parseInt(el.dataset.created) * 1000;

                const diff =
                    Math.floor((Date.now() - created) / 1000);

                const minute =
                    Math.floor(diff / 60);

                const second =
                    diff % 60;

                el.innerText =
                    String(minute).padStart(2,'0')
                    + ":"
                    + String(second).padStart(2,'0');

            });

    },1000);
</script>
@endsection