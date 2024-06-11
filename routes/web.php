<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('store_register');

Route::middleware(['group-admin'])->group(function () {
    // Admin specific routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/{product}', [DashboardController::class, 'show'])->name('dashboard.show');
    Route::get('/dashboard/{product}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/{product}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/{product}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Auth specific routes

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    Route::resource('/orders', OrderController::class);

    Route::post('/orders/add-to-cart/{product}', [OrderController::class, 'addToCart'])->name('orders.add_to_cart');
    Route::post('/orders/checkout/{product}', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::get('/orders/ongkir', [OrderController::class, 'ongkir'])->name('orders.ongkir');
    Route::post('/orders/hitung_ongkir', [OrderController::class, 'hitungOngkir'])->name('orders.hitung_ongkir');
    Route::get('orders.payment', [OrderController::class, 'payment'])->name('orders.payment');

});
