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

        return view(
            'kasir.tables.index',
            compact('tables')
        );
    }
}