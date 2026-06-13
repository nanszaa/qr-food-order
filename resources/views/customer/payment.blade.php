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
                            <span class="font-semibold">QRIS</span>
                        </div>

                        {{-- QR Placeholder --}}
                        <div id="pay-button"
                            class="w-48 h-48 bg-indigo-900 cursor-pointer hover:opacity-90 transition flex items-center justify-center text-white text-center p-4">
                            Klik untuk bayar via Midtrans
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: QRIS & Instruksi --}}
                <div class="flex-1">


                    {{-- Cara Pembayaran --}}
                    <div class="bg-gray-50 p-6 rounded-xl text-sm border border-neutral-200">
                        <h3 class="font-semibold mb-5">Cara pembayaran</h3>
                        <div class="space-y-3">
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
                        </div>
                    </div>
                </div>

            </div>

            {{-- KOLOM KIRI: Detail Pesanan & Total --}}

            <!-- <div class="space-y-4">
                            <div class="bg-red-50 p-4 rounded-md">
                                <span class="text-sm font-medium text-red-700">Total Pembayaran</span>
                                <span class="text-xl font-bold text-red-600">Rp
                                    {{ number_format($order->total_price, 0, ',', '.') }}</span>
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
        document.getElementById('pay-button').addEventListener('click', function () {
            snap.pay('{{ $payment->payment_token }}', {
                onSuccess: function (result) {
                    window.location.href = "/payment/success/{{ $order->order_id }}";
                },
                onPending: function (result) {
                    alert('Menunggu pembayaran');
                },
                onError: function (result) {
                    alert('Pembayaran gagal');
                }
            });
        });
    </script>

    <script>
        // Set durasi countdown dalam detik (15 menit = 900 detik)
        let timeInSeconds = 15 * 60;
        const display = document.getElementById('countdown');

        const countdown = setInterval(function () {
            let minutes = Math.floor(timeInSeconds / 60);
            let seconds = timeInSeconds % 60;

            // Menambahkan angka 0 di depan jika angka kurang dari 10
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.innerHTML = "Bayar dalam " + minutes + ":" + seconds;

            // Jika waktu habis
            if (timeInSeconds <= 0) {
                clearInterval(countdown);
                display.innerHTML = "Waktu pembayaran habis";
                // Opsional: Redirect atau disable tombol bayar di sini
                // window.location.reload(); 
            }

            timeInSeconds--;
        }, 1000);
    </script>

@endsection