<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\Customer\TableController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Kasir\DashboardController;
use App\Http\Controllers\Dapur\DashboardController as DapurDashboardController;
use App\Http\Controllers\Kasir\OrderController;
use App\Http\Controllers\Dapur\KitchenController;
use App\Http\Controllers\Kasir\TableController as KasirTableController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// ROUTE CART

Route::post('/cart/add/{menu}', [CartController::class, 'add'])
    ->name('cart.add');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/increase/{menuId}', [CartController::class, 'increase'])
    ->name('cart.increase');

Route::post('/cart/decrease/{menuId}', [CartController::class, 'decrease'])
    ->name('cart.decrease');

Route::post('/cart/remove/{menuId}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::get('/menu/{menu}', [HomeController::class, 'show'])
    ->name('menu.show');



// ROUTE CHECKOUT

Route::get('/checkout', [CartController::class, 'checkout'])
    ->name('checkout');

Route::post('/checkout', [CartController::class, 'processCheckout'])
    ->name('checkout.process');


// ROUTE PAYMENT

Route::get('/payment/{order}', [CartController::class, 'payment'])
    ->name('payment.show');

Route::get('/payment/success/{order}', [CartController::class, 'paymentSuccess'])
    ->name('payment.success');

Route::get(
    '/payment/simulate/{payment}',
    [CartController::class, 'simulatePayment'])->name('payment.simulate'); 

Route::post('/midtrans/callback', [MidtransController::class, 'callback']);
Route::get('/midtrans/complete', [MidtransController::class, 'complete'])->name('midtrans.complete');

// ROUTE UNTUL LOGIN

Route::get('/scan/{token}',[TableController::class, 'scan'])->name('table.scan');

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

// ROUTE UNTUK USER
Route::get('/kasir', [DashboardController::class, 'index']);
Route::get('/dapur',[DapurDashboardController::class, 'index']);

// ROUTE BACKEND KASIR
Route::get('/kasir/orders',[OrderController::class, 'index'])->name('kasir.orders');
Route::get('/kasir/orders/{order}',[OrderController::class, 'show'])->name('kasir.orders.show');
Route::post('/kasir/orders/{order}/status',[OrderController::class, 'updateStatus'])->name('kasir.orders.update-status');
Route::post('/kasir/payment/{payment}/confirm',[OrderController::class, 'confirmPayment'])->name('kasir.payment.confirm');
Route::get('/kasir/tables',[KasirTableController::class, 'index'])->name('kasir.tables');

// ROUTE BACKEND DAPUR
Route::get('/dapur/orders',[KitchenController::class, 'index'])->name('dapur.orders');
Route::post('/dapur/orders/{orderItem}/status',[KitchenController::class, 'updateStatus'])->name('dapur.orders.update-status');