<?php

namespace App\Http\Controllers\Dapur;

use App\Models\OrderItem;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    public function index()
    {
        $status = request('status');

        $items = OrderItem::with([
            'menu',
            'order.customerSession.table'
        ]);


        if ($status) {

            $items->where(
                'kitchen_status',
                $status
            );

        }

        $items = $items
            ->latest()
            ->get();


        $pendingOrders = Order::with([
            'customerSession.table',
            'orderItems.menu'
        ])
            ->where('order_status', 'processing')
            ->whereHas('orderItems', function ($q) {
                $q->where('kitchen_status', 'pending');
            })->get();

        $cookingOrders = Order::with([
            'customerSession.table',
            'orderItems.menu'
        ])
        ->where('order_status', 'processing')
        ->whereHas('orderItems', function ($q) {
            $q->where('kitchen_status', 'cooking');
        })
        ->get();

        $readyOrders = Order::with([
            'customerSession.table',
            'orderItems.menu'
        ])
        ->where('order_status','completed')
        ->whereHas('orderItems', function ($q) {
            $q->where('kitchen_status', 'ready');
        })
        ->get();

        $servedItems = OrderItem::where(
            'kitchen_status',
            'served'
        )->get();

        return view(
            'dapur.orders.index',
            compact(
                'items',
                'pendingOrders',
                'cookingOrders',
                'readyOrders',
                'servedItems',
                'status'
            )
        );
    }

    public function updateStatus(Request $request, $orderItemId)
    {
        $request->validate([
            'kitchen_status' => 'required'
        ]);

        $item = OrderItem::findOrFail($orderItemId);

        $item->update([
            'kitchen_status' => $request->kitchen_status
        ]);

        $order = $item->order;

        $unfinished = $order->orderItems()
            ->where('kitchen_status','!=','ready')
            ->exists();

        if(!$unfinished){

            $order->update([
                'order_status'=>'completed'
            ]);

        }

        return back()->with(
            'success',
            'Status masakan berhasil diubah'
        );
    }

    public function startCooking($orderId)
    {
        $order = Order::findOrFail($orderId);

        $order->update([
            'order_status' => 'processing'
        ]);

        OrderItem::where('order_id',$orderId)
            ->update([
                'kitchen_status'=>'cooking'
            ]);

        return back()->with(
            'success',
            'Pesanan mulai dimasak'
        );
    }

    public function servedOrder($orderId)
    {
        Order::where('order_id',$orderId)
            ->update([
                'order_status'=>'completed'
            ]);

        OrderItem::where('order_id',$orderId)
            ->update([
                'kitchen_status'=>'served'
            ]);

        return back()->with(
            'success',
            'Pesanan selesai'
        );
    }
}