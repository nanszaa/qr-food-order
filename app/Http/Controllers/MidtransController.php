<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Midtrans\Notification;
use App\Services\MidtransService;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {


      \Log::info('MIDTRANS CALLBACK MASUK');
    \Log::info($request->all());

    MidtransService::init();

        $notification = new Notification();

        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status ?? null;
        $orderCode = $notification->order_id;

        $order = Order::where('order_code', $orderCode)->first();

        if (!$order) {
            return response()->json([
                'message' => 'Order tidak ditemukan'
            ], 404);
        }

        $payment = Payment::where('order_id', $order->order_id)->first();

        if (!$payment) {
            return response()->json([
                'message' => 'Payment tidak ditemukan'
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        if (
            $transactionStatus == 'capture' ||
            $transactionStatus == 'settlement'
        ) {

            $payment->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            $order->update([
                'order_status' => 'processing',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PENDING
        |--------------------------------------------------------------------------
        */

        elseif ($transactionStatus == 'pending') {

            $payment->update([
                'status' => 'pending',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | EXPIRED
        |--------------------------------------------------------------------------
        */

        elseif ($transactionStatus == 'expire') {

            $payment->update([
                'status' => 'expired',
            ]);

            $order->update([
                'order_status' => 'cancelled',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | FAILED
        |--------------------------------------------------------------------------
        */

        elseif (
            $transactionStatus == 'cancel' ||
            $transactionStatus == 'deny'
        ) {

            $payment->update([
                'status' => 'failed',
            ]);

            $order->update([
                'order_status' => 'cancelled',
            ]);
        }

        return response()->json([
            'message' => 'OK'
        ]);
    }
}