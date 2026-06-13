<?php

namespace App\Http\Controllers\Kasir;

use App\Models\Order;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Table;
use App\Models\Payment;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();

        $totalMenus = Menu::count();

        $totalCategories = Category::count();

        $totalTables = Table::count();

        $paidPayments = Payment::where(
            'status',
            'paid'
        )->count();

        $pendingPayments = Payment::where(
            'status',
            'pending'
        )->count();

        $todayRevenue = Payment::where(
            'status',
            'paid'
        )->sum('amount');

        // Pendapatan 7 hari terakhir

        $revenueLabels = [];
        $revenueData = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = Carbon::now()->subDays($i);

            $revenueLabels[] = $date->format('d M');

            $revenueData[] = Payment::where(
                'status',
                'paid'
            )
                ->whereDate(
                    'paid_at',
                    $date
                )
                ->sum('amount');
        }

        // Status Order

        $pendingOrders = Order::where(
            'order_status',
            'pending'
        )->count();

        $processingOrders = Order::where(
            'order_status',
            'processing'
        )->count();

        $completedOrders = Order::where(
            'order_status',
            'completed'
        )->count();

        $cancelledOrders = Order::where(
            'order_status',
            'cancelled'
        )->count();

        return view(
            'kasir.dashboard',
            compact(
                'totalOrders',
                'totalMenus',
                'totalCategories',
                'totalTables',
                'paidPayments',
                'pendingPayments',
                'todayRevenue',

                'revenueLabels',
                'revenueData',

                'pendingOrders',
                'processingOrders',
                'completedOrders',
                'cancelledOrders'
            )
        );
    }
}