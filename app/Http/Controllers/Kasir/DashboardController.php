<?php

namespace App\Http\Controllers\Kasir;

use App\Models\Order;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Table;
use App\Models\Payment;
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

    return view(
        'kasir.dashboard',
        compact(
            'totalOrders',
            'totalMenus',
            'totalCategories',
            'totalTables',
            'paidPayments',
            'pendingPayments',
            'todayRevenue'
        )
    );
}
}