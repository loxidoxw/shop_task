<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::get('product', [App\Http\Controllers\Web\ProductController::class, 'index'])->name('product.index');
Route::get('product/create', [App\Http\Controllers\Web\ProductController::class, 'create'])->name('product.create');
Route::post('product/store', [App\Http\Controllers\Web\ProductController::class, 'store'])->name('product.store');
