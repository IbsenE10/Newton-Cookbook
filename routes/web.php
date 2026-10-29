<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.welcome', [
        // alleen zichtbare recepten op de homepage
        'latestProduct' => Product::where('is_visible', true)->latest()->first(),
    ]);
});
Route::view('/about', 'layouts.about');
Route::view('/contact', 'layouts.contact');
Route::post('/contact', function (Illuminate\Http\Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'issue' => ['required', 'string', 'min:10', 'max:2000'],
    ]);

    // het bericht wordt nog nergens opgeslagen of verstuurd, alleen gecontroleerd
    return redirect('/contact')->with('status', "We received your message and will get back to you soon.");
})->name('contact.send');

Route::get('/dashboard', function () {
    return view('layouts.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Only logged-in users can create, edit and delete
// (registered first so /products/create isn't caught by /products/{product})
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class)->except(['index', 'show']);
});

// Anyone can view products
Route::resource('products', ProductController::class)->only(['index', 'show']);

//Route::get('/admin', function () {
//    Gate::authorize('view-admin');
//    return view('layouts.admin');
//})->middleware('auth');
////ook andere manier is
//Route::view('/admin', 'layouts.admin')->middleware('auth')->can('view-admin');

// Admin: alle routes in deze groep zijn alleen voor ingelogde admins
Route::middleware(['auth', 'can:view-admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::patch('/products/{product}/visibility', [AdminController::class, 'toggleVisibility'])->name('products.visibility');
});
