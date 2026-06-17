<?php

namespace App\Http\Controllers\Kasir;

use App\Models\Table;
use App\Models\CustomerSession;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class TableController extends Controller
{
    public function index()
    {
        $tables = Table::with([
            'customerSessions.orders'
        ])->get();

        $occupiedCount = 0;
        $pendingCount = 0;
        $kitchenCount = 0;

        foreach ($tables as $table) {

            // Cek apakah ada session aktif
            $activeSession = $table->customerSessions
                ->where('status', 'active')
                ->first();

            if ($activeSession) {

                $occupiedCount++;

                foreach ($activeSession->orders as $order) {

                    if ($order->order_status === 'pending') {
                        $pendingCount++;
                    }

                    if ($order->order_status === 'processing') {
                        $kitchenCount++;
                    }
                }
            }
        }

        $availableCount = $tables->count() - $occupiedCount;

        return view(
            'kasir.tables.index',
            compact(
                'tables',
                'occupiedCount',
                'availableCount',
                'pendingCount',
                'kitchenCount'
            )
        );
    }
    public function show(Table $table)
    {
        $table->load([
            'customerSessions.orders.orderItems',
            'customerSessions.orders.payment'
        ]);

        return view(
            'kasir.tables.show',
            compact('table')
        );
    }

    public function closeSession($sessionId)
    {
        $session = CustomerSession::findOrFail(
            $sessionId
        );

        $session->update([
            'status' => 'closed'
        ]);

        return back()->with(
            'success',
            'Session berhasil ditutup'
        );
    }

    public function create()
    {
        return view('kasir.tables.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|unique:tables'
        ]);

        Table::create([
            'table_number' => $request->table_number,
            'qr_token' => Str::uuid(),
            'is_active' => true,
        ]);

        return redirect()
            ->route('kasir.tables')
            ->with('success', 'Meja berhasil ditambahkan');
    }

    public function edit(Table $table)
    {
        return view(
            'kasir.tables.edit',
            compact('table')
        );
    }

    public function update(Request $request, Table $table)
    {
        $request->validate([
            'table_number' => 'required'
        ]);

        $table->update([
            'table_number' => $request->table_number,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()
            ->route('kasir.tables')
            ->with('success', 'Meja berhasil diupdate');
    }

    public function destroy(Table $table)
    {
        $table->delete();

        return back()->with(
            'success',
            'Meja berhasil dihapus'
        );
    }
}