<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;

class OrderController extends Controller
{
    public function index()
    {
        $status = request('status');

        $orders = Order::with([
            'payment',
            'customerSession.table'
        ]);

        if ($status) {

            $orders->where(
                'order_status',
                $status
            );
        }

        $orders = $orders
            ->latest()
            ->get();

        $pendingCount = Order::where(
            'order_status',
            'pending'
        )->count();

        $processingCount = Order::where(
            'order_status',
            'processing'
        )->count();

        $completedCount = Order::where(
            'order_status',
            'completed'
        )->count();

        $cancelledCount = Order::where(
            'order_status',
            'cancelled'
        )->count();

        return view(
            'kasir.orders.index',
            compact(
                'orders',
                'pendingCount',
                'processingCount',
                'completedCount',
                'cancelledCount',
                'status'
            )
        );
    }

    public function show($orderId)
    {
        $order = Order::with([
            'payment',
            'customerSession.table',
            'orderItems.menu'
        ])->findOrFail($orderId);

        return view(
            'kasir.orders.show',
            compact('order')
        );
    }

    public function updateStatus(Request $request, $orderId)
    {
        $request->validate([
            'order_status' => 'required'
        ]);

        $order = Order::findOrFail($orderId);

        $order->update([
            'order_status' => $request->order_status
        ]);

        return back()->with(
            'success',
            'Status pesanan berhasil diubah'
        );
    }

    public function history()
    {
        $orders = Order::with([
            'payment',
            'customerSession.table'
        ])
            ->whereIn('order_status', [
                'completed',
                'cancelled'
            ])
            ->latest()
            ->get();

        return view(
            'kasir.orders.history',
            compact('orders')
        );
    }

    public function confirmPayment(Payment $payment)
    {
        $payment->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return back()->with(
            'success',
            'Pembayaran berhasil dikonfirmasi'
        );
    }

    public function receipt($orderId)
    {
        $order = Order::with([
            'payment',
            'customerSession.table',
            'orderItems.menu'
        ])->findOrFail($orderId);

        return view(
            'kasir.orders.receipt',
            compact('order')
        );
    }


}