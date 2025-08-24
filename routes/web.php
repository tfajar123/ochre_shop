<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\View\ProductViewController;
use App\Http\Controllers\View\OrderViewController;
use App\Http\Controllers\View\DashboardViewController;
use App\Http\Controllers\AuthController;

Route::get('/', [ProductViewController::class, 'mainIndex']);

Route::get('/products', [ProductViewController::class, 'index'])->name('products.index');
// Route::get('/products/{id}', [ProductViewController::class, 'show']);
Route::get('/products/search', [ProductViewController::class, 'search'])->name('products.search');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderViewController::class, 'checkout']);
    Route::get('/orders', [OrderViewController::class, 'index']);
    Route::get('/orders/{id}', [OrderViewController::class, 'show']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardViewController::class, 'index'])->name('index');
    Route::get('/products', [DashboardViewController::class, 'products'])->name('products');
    Route::get('/products/create', [DashboardViewController::class, 'create'])->name('products.create');
    Route::get('/products/{id}/edit', [DashboardViewController::class, 'edit'])->name('products.edit');
    Route::get('/orders', [DashboardViewController::class, 'showOrders'])->name('ordersDashboard');
});

Route::get('/login', function () {
    return redirect('/');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);


