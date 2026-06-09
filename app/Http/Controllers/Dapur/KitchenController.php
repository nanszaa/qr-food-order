<?php

namespace App\Http\Controllers\Dapur;

use App\Models\OrderItem;
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


        $pendingCount = OrderItem::where(
            'kitchen_status',
            'pending'
        )->count();

        $cookingCount = OrderItem::where(
            'kitchen_status',
            'cooking'
        )->count();

        $readyCount = OrderItem::where(
            'kitchen_status',
            'ready'
        )->count();

        $servedCount = OrderItem::where(
            'kitchen_status',
            'served'
        )->count();

                return view(
            'dapur.orders.index',
            compact(
                'items',
                'pendingCount',
                'cookingCount',
                'readyCount',
                'servedCount',
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

        $unfinishedItems = $order->orderItems()
            ->where('kitchen_status', '!=', 'ready')
            ->count();

        if ($unfinishedItems == 0) {

            $order->update([
                'order_status' => 'completed'
            ]);
        }

        return back()->with(
            'success',
            'Status masakan berhasil diubah'
        );
    }
}