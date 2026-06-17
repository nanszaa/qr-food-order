<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
class ReportController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::with('order')
            ->where('status', 'paid');

        // Filter tanggal
        if (
            $request->start_date &&
            $request->end_date
        ) {
            $payments->whereDate(
                'paid_at',
                '>=',
                $request->start_date
            );

            $payments->whereDate(
                'paid_at',
                '<=',
                $request->end_date
            );
        }

        $payments = $payments
            ->latest()
            ->get();

        // Total pendapatan hasil filter
        $totalRevenue = $payments->sum('amount');

        // Ringkasan hari ini
        $todayRevenue = Payment::where(
            'status',
            'paid'
        )
            ->whereDate(
                'paid_at',
                today()
            )
            ->sum('amount');

        $todayTransactions = Payment::where(
            'status',
            'paid'
        )
            ->whereDate(
                'paid_at',
                today()
            )
            ->count();

        $bestSellingMenus = OrderItem::select(
            'menu_id',
            DB::raw('SUM(quantity) as total_sold')
        )
            ->with('menu')
            ->groupBy('menu_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // Reset semua best seller
        Menu::query()->update([
            'is_best_seller' => false
        ]);

        // Ambil Top 3
        $topThreeMenus = $bestSellingMenus
            ->take(3)
            ->pluck('menu_id');

        // Jadikan best seller
        Menu::whereIn(
            'menu_id',
            $topThreeMenus
        )->update([
                    'is_best_seller' => true
                ]);

        return view(
            'kasir.reports.index',
            compact(
                'payments',
                'totalRevenue',
                'todayRevenue',
                'todayTransactions',
                'bestSellingMenus'
            )
        );
    }

    public function print(Request $request)
    {
        $payments = Payment::with('order')
            ->where('status', 'paid');

        if (
            $request->start_date &&
            $request->end_date
        ) {
            $payments->whereDate(
                'paid_at',
                '>=',
                $request->start_date
            );

            $payments->whereDate(
                'paid_at',
                '<=',
                $request->end_date
            );
        }

        $payments = $payments
            ->latest()
            ->get();

        $totalRevenue = $payments->sum('amount');

        $bestSellingMenus = OrderItem::select(
            'menu_id',
            DB::raw('SUM(quantity) as total_sold')
        )
            ->with('menu')
            ->groupBy('menu_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        $pdf = Pdf::loadView(
            'kasir.reports.pdf',
            compact(
                'payments',
                'totalRevenue',
                'bestSellingMenus'
            )
        );

        return $pdf->stream(
            'laporan-penjualan.pdf'
        );
    }
}