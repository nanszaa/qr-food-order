<?php

namespace App\Http\Controllers\Customer;

use App\Models\Table;
use App\Http\Controllers\Controller;

class TableController extends Controller
{
    public function scan($token)
    {
        $table = Table::where(
            'qr_token',
            $token
        )
        ->where(
            'is_active',
            true
        )
        ->firstOrFail();

        session([
            'table_id' => $table->id
        ]);

        return redirect('/');
    }
}