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

//products
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/create_product', [App\Http\Controllers\ProductController::class, 'store']); // create product
    Route::put('/products/{id}', [App\Http\Controllers\ProductController::class, 'update']); // update product
    Route::delete('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy']); // delete product
});

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show']);


//comments
Route::middleware(['auth', 'verified'])->group(function ()
{
    Route::post('/products/{id}/comments', [App\Http\Controllers\CommentController::class, 'store']);
    Route::delete('/products/{id}/comments', [App\Http\Controllers\CommentController::class, 'destroy']);
}
);
Route::get('/get_products/{id}/comments', [App\Http\Controllers\CommentController::class, 'index']);
