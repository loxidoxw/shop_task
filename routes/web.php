<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


