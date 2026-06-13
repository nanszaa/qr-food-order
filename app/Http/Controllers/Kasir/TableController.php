<?php

namespace App\Http\Controllers\Kasir;

use App\Models\Table;
use App\Http\Controllers\Controller;

class TableController extends Controller
{
    public function index()
    {
         $tables = Table::with([
        'customerSessions.orders'
    ])->get();

    $occupiedCount = 0;

    foreach ($tables as $table) {

        $occupied = false;

        foreach ($table->customerSessions as $session) {

            foreach ($session->orders as $order) {

                if (
                    in_array(
                        $order->order_status,
                        ['pending', 'processing']
                    )
                ) {
                    $occupied = true;
                }
            }
        }

        if ($occupied) {
            $occupiedCount++;
        }
    }

    $availableCount =
        $tables->count() - $occupiedCount;

    return view(
        'kasir.tables.index',
        compact(
            'tables',
            'occupiedCount',
            'availableCount'
        )
    );
    }
}