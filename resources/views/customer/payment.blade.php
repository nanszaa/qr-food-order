@extends('layouts.customer.customer')

@section('title', 'Pembayaran')

@section('content')

    <div class="min-h-screen bg-brand-bg">
        <div class="max-w-7xl mx-auto px-4 lg:px-6 py-6">

            <div class="flex flex-col lg:flex-row xl:flex-row gap-4">

                <div class="flex-1">
                    <div
                        class="flex items-center justify-between w-full bg-neutral-50 p-3 border border-neutral-200 rounded-xl mb-4">
                        <div>
                            <p class="text-neutral-500 text-sm">
                                Total Pembayaran
                            </p>
                            <h1 class="text-2xl font-bold text-brand-600">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </h1>
                        </div>

                        {{-- Elemen HTML untuk menampilkan timer --}}
                        <p id="countdown" class="text-xs px-5 py-3 rounded-lg text-white font-semibold bg-danger">
                            Bayar dalam 15:00
                        </p>
                    </div>

                    {{-- Kotak QR --}}
                    <div
                        class="border border-neutral-200 rounded-xl p-6 flex flex-col items-center justify-center bg-gray-50 gap-4">

                        <div class="flex flex-col items-center">
                            <p class="text-sm text-neutral-500">Payment Method</p>
                            <span class="font-semibold">
                                {{ strtoupper($payment->method) }}
                            </span>
                        </div>

                        {{-- QR Placeholder --}}
                        @if(isset($paymentData['qr_string']))

                            <div class="bg-white p-3 rounded-lg">
                                {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(220)->generate($paymentData['qr_string']) !!}
                            </div>
                            <!-- <pre>
                                {{ print_r($paymentData['actions'], true) }}
                            </pre> -->

                        @elseif($payment->method == 'permata')

                            {{ $paymentData['permata_va_number'] }}
                            <button onclick="copyVA()"
                                class="bg-brand-700 text-white px-4 py-2 rounded-lg">
                                Copy VA
                            </button>

                        @else

                            {{ $paymentData['va_numbers'][0]['va_number'] }}
                            <button onclick="copyVA()"
                                class="bg-brand-700 text-white px-4 py-2 rounded-lg">
                                Copy VA
                            </button>

                        @endif
                    </div>
                </div>

                {{-- KOLOM KANAN: QRIS & Instruksi --}}
                <div class="flex-1">

                    {{-- Cara Pembayaran --}}
                    <div class="bg-gray-50 p-6 rounded-xl text-sm border border-neutral-200">
                        <h3 class="font-semibold mb-5">Cara pembayaran</h3>
                        <div class="space-y-3">

                            @if($payment->method == 'qris')

                                <div class="flex items-center gap-3">
                                    <div
                                        class="bg-brand-700 w-6 h-6 rounded-full items-center justify-center flex text-white text-xs">
                                        1</div>
                                    <p class="text-neutral-500">Buka aplikasi mobile banking atau e-wallet.</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="bg-brand-700 w-6 h-6 rounded-full items-center justify-center flex text-white text-xs">
                                        2</div>
                                    <p class="text-neutral-500">Pilih fitur scan QRIS dan arahkan kamera ke kode di layar.</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="bg-brand-700 w-6 h-6 rounded-full items-center justify-center flex text-white text-xs">
                                        3</div>
                                    <p class="text-neutral-500">Pastikan nama merchant adalah Warkop KUY dan nominal sesuai.</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="bg-brand-700 w-6 h-6 rounded-full items-center justify-center flex text-white text-xs">
                                        4</div>
                                    <p class="text-neutral-500">Masukkan PIN Anda dan selesaikan pembayaran.</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="bg-brand-700 w-6 h-6 rounded-full items-center justify-center flex text-white text-xs">
                                        5</div>
                                    <p class="text-neutral-500">Tunggu sampai halaman berubah otomatis.</p>
                                </div>

                            @else

                                <div class="flex items-center gap-3">
                                    <div
                                        class="bg-brand-700 w-6 h-6 rounded-full items-center justify-center flex text-white text-xs">
                                        1</div>
                                    <p class="text-neutral-500">Buka aplikasi mobile banking.</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="bg-brand-700 w-6 h-6 rounded-full items-center justify-center flex text-white text-xs">
                                        2</div>
                                    <p class="text-neutral-500">Pilih transfer virtual account.</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="bg-brand-700 w-6 h-6 rounded-full items-center justify-center flex text-white text-xs">
                                        3</div>
                                    <p class="text-neutral-500">Masukkan nomor VA.</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="bg-brand-700 w-6 h-6 rounded-full items-center justify-center flex text-white text-xs">
                                        4</div>
                                    <p class="text-neutral-500">Pastikan nominal sesuai.</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="bg-brand-700 w-6 h-6 rounded-full items-center justify-center flex text-white text-xs">
                                        5</div>
                                    <p class="text-neutral-500">Selesaikan pembayaran.</p>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>

            </div>

            {{-- KOLOM KIRI: Detail Pesanan & Total --}}

            <!-- <div class="space-y-4">
                <div class="bg-red-50 p-4 rounded-md">
                    <span class="text-sm font-medium text-red-700">Total Pembayaran</span>
                    <span class="text-xl font-bold text-red-600">Rp
                        {{ number_format($order->total_price, 0, ',', '.') }}
                    </span>
                </div>

                {{-- Detail Item --}}
                <div class="text-sm text-gray-600 space-y-2 border-t pt-4">
                    @foreach($order->orderItems as $item)
                        <div class="flex justify-between">
                            <span>{{ $item->qty }}x {{ $item->menu->name }}</span>
                            <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            </div> -->
        </div>
    </div>

    <script>
        function copyVA() {
            navigator.clipboard.writeText(
                document.getElementById('va-number').innerText
            );
            alert("Nomor VA berhasil disalin");
        }
    </script>

    <script>

        const expired = new Date("{{ $payment->expires_at }}").getTime();
        const display = document.getElementById("countdown");
        const countdown = setInterval(function () {

            const now = new Date().getTime();
            const distance = expired - now;

            if (distance <= 0) {
                clearInterval(countdown);
                display.innerHTML = "Pembayaran kadaluarsa";
                return;
            }

            const minutes = Math.floor(distance / 1000 / 60);
            const seconds = Math.floor((distance / 1000) % 60);

            display.innerHTML =
                "Bayar dalam "
                + String(minutes).padStart(2, "0")
                + ":"
                + String(seconds).padStart(2, "0");
        }, 1000);

    </script>

    <script>
        setInterval(function () {
            fetch("{{ route('payment.status', $order->order_id) }}")

                .then(res => res.json())
                .then(data => {

                    if (data.status == "paid") {
                        window.location.href =
                            "{{ route('payment.success', $order->order_id) }}";
                    }
                });
        }, 3000);
    </script>

@endsection