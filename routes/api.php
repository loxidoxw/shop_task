<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


//Registraion, login and logout
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:sanctum');

//products
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/create_product', [App\Http\Controllers\ProductController::class, 'store']); // create product
    Route::put('/products/{id}', [App\Http\Controllers\ProductController::class, 'update']); // update product
    Route::delete('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy']); // delete product
});

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show']);


//comments
Route::middleware(['auth:sanctum'])->group(function ()
{
    Route::post('/comments', [App\Http\Controllers\CommentController::class, 'store']);
    Route::delete('/comments/{id}', [App\Http\Controllers\CommentController::class, 'destroy']);
}
);
Route::get('comments{id}', [App\Http\Controllers\CommentController::class, 'index']);


//orders
Route::middleware(['auth:sanctum'])->group(function ()
{
    Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store']); // make order
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index']); //check order history
}
);
