<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    route::post('/create_product', [App\Http\Controllers\ProductController::class, 'store']); // create product
    route::put('/products/{id}', [App\Http\Controllers\ProductController::class, 'update']); // update product
    route::delete('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy']); // delete product
});

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show']);
