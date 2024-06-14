<?php

use App\Http\Controllers\api\LoginApiController;
use App\Http\Controllers\api\ProductApiController;
use App\Http\Controllers\api\RegisterApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('/register', [RegisterApiController::class, 'register']);
Route::post('/login', [LoginApiController::class, 'login'])->name('login');

// Group routes that require authentication
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/{product}', [DashboardController::class, 'show'])->name('dashboard.show');
    Route::get('/dashboard/{product}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/{product}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/{product}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
    
    Route::get('/products', [ProductApiController::class, 'index'])->name('product.index');
    Route::post('/products', [ProductApiController::class, 'store'])->name('product.store');

})->middleware('auth:sanctum');
