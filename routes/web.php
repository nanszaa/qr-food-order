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
use App\Http\Controllers\Kasir\CategoryController;
use App\Http\Controllers\Kasir\MenuController;
use App\Http\Controllers\Kasir\ReportController;

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
    [CartController::class, 'simulatePayment']
)->name('payment.simulate');

Route::post('/midtrans/callback', [MidtransController::class, 'callback']);
Route::get('/midtrans/complete', [MidtransController::class, 'complete'])->name('midtrans.complete');

// ROUTE UNTUL LOGIN

Route::get('/scan/{token}', [TableController::class, 'scan'])->name('table.scan');

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

// ROUTE UNTUK USER

// GROUP ROUTE BACKEND KASIR
Route::middleware([
    'auth',
    'role:kasir'
])->group(function () {

    Route::get('/kasir', [
        DashboardController::class,
        'index'
    ])->name('kasir.dashboard');

     Route::get(
    '/kasir/tables/{table}',
    [KasirTableController::class, 'show']
)->name('kasir.tables.show');

    Route::get('/kasir/orders', [
        OrderController::class,
        'index'
    ])->name('kasir.orders');

    Route::get(
    '/kasir/orders/history',
    [OrderController::class, 'history']
    )->name('kasir.orders.history');

    Route::get('/kasir/orders/{order}', [
        OrderController::class,
        'show'
    ])->name('kasir.orders.show');

    Route::post('/kasir/orders/{order}/status', [
        OrderController::class,
        'updateStatus'
    ])->name('kasir.orders.update-status');

    Route::post('/kasir/payments/{payment}/confirm', [
        OrderController::class,
        'confirmPayment'
    ])->name('kasir.payment.confirm');

    Route::get('/kasir/tables', [
        KasirTableController::class,
        'index'
    ])->name('kasir.tables');

    Route::get(
    '/kasir/orders/{order}/receipt',
    [OrderController::class, 'receipt']
    )->name('kasir.orders.receipt');

    // BAGIAN CATEGORIE
    Route::get(
        '/kasir/categories',
        [CategoryController::class, 'index']
    )->name('kasir.categories');

    Route::get(
        '/kasir/categories/create',
        [CategoryController::class, 'create']
    )->name('kasir.categories.create');

    Route::post(
        '/kasir/categories',
        [CategoryController::class, 'store']
    )->name('kasir.categories.store');

    Route::get(
        '/kasir/categories/{category}/edit',
        [CategoryController::class, 'edit']
    )->name('kasir.categories.edit');

    Route::put(
        '/kasir/categories/{category}',
        [CategoryController::class, 'update']
    )->name('kasir.categories.update');

    Route::delete(
        '/kasir/categories/{category}',
        [CategoryController::class, 'destroy']
    )->name('kasir.categories.destroy');

// BAGIAN MENU

    Route::get(
        '/kasir/menus',
        [MenuController::class, 'index']
    )->name('kasir.menus');

    Route::get(
        '/kasir/menus/create',
        [MenuController::class, 'create']
    )->name('kasir.menus.create');

    Route::post(
        '/kasir/menus',
        [MenuController::class, 'store']
    )->name('kasir.menus.store');

        Route::get(
        '/kasir/menus/{menu}/edit',
        [MenuController::class, 'edit']
    )->name('kasir.menus.edit');

    Route::put(
        '/kasir/menus/{menu}',
        [MenuController::class, 'update']
    )->name('kasir.menus.update');

    Route::delete(
    '/kasir/menus/{menu}',
    [MenuController::class, 'destroy']
    )->name('kasir.menus.destroy');


    Route::get(
    '/kasir/reports',
    [ReportController::class, 'index']
    )->name('kasir.reports');

   
    

});




// ROUTE BACKEND DAPUR
Route::middleware(['auth', 'role:dapur'])->group(function () {

    Route::get('/dapur', [DapurDashboardController::class, 'index'])
        ->name('dapur.dashboard');

    Route::get('/dapur/orders', [KitchenController::class, 'index'])
        ->name('dapur.orders.index');

    Route::post('/dapur/orders/{orderItem}/status', [KitchenController::class, 'updateStatus'])
        ->name('dapur.orders.update-status');

    Route::post('/dapur/orders/{order}/start', [KitchenController::class, 'startCooking'])
        ->name('dapur.orders.start');

    Route::post('/dapur/orders/{order}/served', [KitchenController::class, 'servedOrder'])
        ->name('dapur.orders.served');
});