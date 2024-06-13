<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WAController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('store_register');

// Group routes that require authentication
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware(['group-admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
        Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
        Route::get('/dashboard/{product}', [DashboardController::class, 'show'])->name('dashboard.show');
        Route::get('/dashboard/{product}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
        Route::put('/dashboard/{product}', [DashboardController::class, 'update'])->name('dashboard.update');
        Route::delete('/dashboard/{product}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
    });
});

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware(['auth'])->group(function () {
    // Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    // Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

    Route::get('/orders/checkout/{product}', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/orders/payment', [OrderController::class, 'payment'])->name('orders.payment');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/order/status', [OrderController::class, 'status'])->name('orders.status');
});

Route::get('/customer-service', [WAController::class, 'index'])->name('customer.service');
Route::get('/customer-service/whatsapp', [WAController::class, 'redirectToWhatsApp'])->name('customer.service.whatsapp');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');