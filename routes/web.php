<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Only logged-in users can create, edit and delete.
// This group must come before the public routes, otherwise /products/create
// is read as /products/{product} with "create" as the id.
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class)->except(['index', 'show']);
});

// Anyone can view products
Route::resource('products', ProductController::class)->only(['index', 'show']);
