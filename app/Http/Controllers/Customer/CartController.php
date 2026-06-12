<?php

namespace App\Http\Controllers\Customer;

use App\Models\CustomerSession;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Services\MidtransService;

class CartController extends Controller
{
    public function add(Menu $menu)
    {
        $cart = session()->get('cart', []);

        $qty = request('qty', 1);

        $notes = request('notes', '');

        if (isset($cart[$menu->menu_id])) {

            $cart[$menu->menu_id]['qty'] += $qty;

            if (!empty($notes)) {
                $cart[$menu->menu_id]['notes'] = $notes;
            }

        } else {

            $cart[$menu->menu_id] = [
                'menu_id' => $menu->menu_id,
                'name' => $menu->name,
                'price' => $menu->price,
                'qty' => $qty,
                'notes' => $notes,
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Menu berhasil ditambahkan');
    }

    public function index()
    {
        $cart = session()->get('cart', []);

        return view('customer.cart', compact('cart'));
    }

    public function increase($menuId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$menuId])) {
            $cart[$menuId]['qty']++;
        }

        session()->put('cart', $cart);

        return back();
    }

    public function decrease($menuId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$menuId])) {

            $cart[$menuId]['qty']--;

            if ($cart[$menuId]['qty'] <= 0) {
                unset($cart[$menuId]);
            }
        }

        session()->put('cart', $cart);

        return back();
    }

    public function remove($menuId)
    {
        $cart = session()->get('cart', []);

        unset($cart[$menuId]);

        session()->put('cart', $cart);

        return back();
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        return view('customer.checkout', compact('cart'));
    }

    public function processCheckout()
    {

        if (!session()->has('table_id')) {

            return redirect('/')
                ->with(
                    'error',
                    'Silakan scan QR meja terlebih dahulu.'
                );
        }

        request()->validate([
            'customer_name' => 'required|min:2|max:100',
            'payment_method' => 'required|in:qris,cash',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        /*
        |--------------------------------------------------------------------------
        | Customer Session
        |--------------------------------------------------------------------------
        */

       $customerSession = CustomerSession::create([
            'table_id' => session('table_id'),
            'session_token' => Str::uuid(),
            'customer_name' => request('customer_name'),
            'status' => 'active',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Order
        |--------------------------------------------------------------------------
        */

        $order = Order::create([
            'customer_session_id' => $customerSession->customer_session_id,
            'order_code' => 'ORD-' . strtoupper(Str::random(8)),
            'total_price' => $total,
            'order_status' => 'pending',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Order Items
        |--------------------------------------------------------------------------
        */

        foreach ($cart as $item) {

            OrderItem::create([
                'order_id' => $order->order_id,
                'menu_id' => $item['menu_id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['qty'],
                'item_notes' => $item['notes'] ?? null,
                'kitchen_status' => 'pending',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Payment
        |--------------------------------------------------------------------------
        */

        $payment = Payment::create([
            'order_id' => $order->order_id,
            'method' => request('payment_method'),
            'amount' => $total,
            'status' => 'pending',
        ]);

        if (request('payment_method') === 'qris') {

            $snapToken = MidtransService::createSnapToken($order);

            $payment->update([
                'payment_token' => $snapToken
            ]);

            return redirect()
                ->route('payment.show', $order->order_id);
        }

        session()->forget('cart');

        return redirect()
            ->route('cart.index')
            ->with('success', 'Pesanan berhasil dibuat');
    }

    public function payment($orderId)
    {
        $order = Order::with([
            'payment',
            'orderItems.menu',
            'customerSession.table',
        ])->findOrFail($orderId);

        $payment = Payment::where('order_id', $orderId)->first();

        return view(
            'customer.payment',
            compact('order', 'payment')
        );
    }

    public function paymentSuccess($orderId)
    {
        $order = Order::with([
            'payment',
            'orderItems.menu',
            'customerSession.table',
        ])->findOrFail($orderId);

        if (
            $order->payment &&
            $order->payment->status !== 'paid'
        ) {

            $order->payment->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            $order->update([
                'order_status' => 'processing',
            ]);
        }

        session()->forget('cart');

        return view(
            'customer.payment-success',
            compact('order')
        );
    }

    public function simulatePayment(Payment $payment)
    {
        /*
        |--------------------------------------------------------------------------
        | Update Payment
        |--------------------------------------------------------------------------
        */

        $payment->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Order
        |--------------------------------------------------------------------------
        */

        $payment->order->update([
            'order_status' => 'processing',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Hapus Cart Session
        |--------------------------------------------------------------------------
        */

        session()->forget('cart');

        /*
        |--------------------------------------------------------------------------
        | Redirect Success
        |--------------------------------------------------------------------------
        */

        return redirect()->route(
            'payment.success',
            $payment->order->order_id
        );
}
}