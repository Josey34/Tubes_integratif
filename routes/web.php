<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;

// Route::get('/', function () {
//     return view('Home');
// });

// Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('store_register');

Route::resource('/product', ProductController::class);

Route::resource('/orders', OrderController::class);

Route::post('/orders/add-to-cart/{product}', [OrderController::class, 'addToCart'])->name('orders.add_to_cart');
Route::post('/checkout/{product_id}', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/process_checkout', [OrderController::class, 'checkout']);

