<?php

namespace App\Http\Controllers\Dapur;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    public function index()
    {
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
            'dapur.dashboard',
            compact(
                'pendingCount',
                'cookingCount',
                'readyCount',
                'servedCount'
            )
        );
    }
}