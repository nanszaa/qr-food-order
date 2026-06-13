<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

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

        return view(
            'kasir.reports.index',
            compact(
                'payments',
                'totalRevenue',
                'todayRevenue',
                'todayTransactions'
            )
        );
    }
}