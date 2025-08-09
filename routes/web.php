<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\View\ProductViewController;
use App\Http\Controllers\View\OrderViewController;
use App\Http\Controllers\View\DashboardViewController;

Route::get('/', [ProductViewController::class, 'mainIndex']);

Route::get('/products', [ProductViewController::class, 'index']);
Route::get('/products/{id}', [ProductViewController::class, 'show']);

Route::get('/checkout', [OrderViewController::class, 'checkout']);
Route::get('/orders', [OrderViewController::class, 'index']);
Route::get('/orders/{id}', [OrderViewController::class, 'show']);

Route::get('/dashboard', [DashboardViewController::class, 'index']);
Route::get('/dashboard/products', [DashboardViewController::class, 'products'])->name('dashboard.products');
Route::get('/dashboard/products/create', [DashboardViewController::class, 'create'])->name('dashboard.products.create');
Route::get('/dashboard/products/{id}/edit', [DashboardViewController::class, 'edit'])->name('dashboard.products.edit');