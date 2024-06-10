<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;

// Route::get('/', function () {
//     return view('Home');
// });

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('store_register');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/product', ProductController::class);
Route::resource('/dashboard/products', ProductController::class);
Route::get('/dashboard/products', [ProductController::class, 'dashboard_index'])->name('dashboard.products.index');
Route::get('/dashboard/products/{product}', [ProductController::class, 'show'])->name('dashboard.products.show');

Route::resource('/orders', OrderController::class);

Route::post('/orders/add-to-cart/{product}', [OrderController::class, 'addToCart'])->name('orders.add_to_cart');
Route::post('/orders/checkout/{product}', [OrderController::class, 'checkout'])->name('orders.checkout');
Route::get('/orders/ongkir', [OrderController::class, 'ongkir'])->name('orders.ongkir');
Route::post('/orders/hitung_ongkir', [OrderController::class, 'hitungOngkir'])->name('orders.hitung_ongkir');
Route::get('orders.payment', [OrderController::class, 'payment'])->name('orders.payment');
