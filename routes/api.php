<?php

use Illuminate\Support\Facades\Route;


//Registraion, login and logout
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:sanctum');

//product
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/create_product', [\App\Http\Controllers\Api\ProductController::class, 'store']); // create product
    Route::put('/product/{id}', [\App\Http\Controllers\Api\ProductController::class, 'update']); // update product
    Route::delete('/product/{id}', [\App\Http\Controllers\Api\ProductController::class, 'destroy']); // delete product
});

Route::get('/product', [\App\Http\Controllers\Api\ProductController::class, 'index']);
Route::get('/product/{id}', [\App\Http\Controllers\Api\ProductController::class, 'show']);


//comments
Route::middleware(['auth:sanctum'])->group(function ()
{
    Route::post('/comments', [\App\Http\Controllers\Api\CommentController::class, 'store']);
    Route::delete('/comments/{id}', [\App\Http\Controllers\Api\CommentController::class, 'destroy']);
});
Route::get('comments/{id}', [\App\Http\Controllers\Api\CommentController::class, 'index']);


//orders
Route::middleware(['auth:sanctum'])->group(function ()
{
    Route::post('/orders', [\App\Http\Controllers\Api\OrderController::class, 'store']); // make order
    Route::get('/orders', [\App\Http\Controllers\Api\OrderController::class, 'index']); //check order history
}
);
