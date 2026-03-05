<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\ProductController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;

/*
|----------------------------------------------------------
| PUBLIC ROUTES
|----------------------------------------------------------
*/
Route::get('/', function () {
    $latest = \App\Models\Product::with('images')->latest()->take(8)->get();
    $count  = \App\Models\Product::count();
    return view('public.home', compact('latest', 'count'));
})->name('home');

Route::get('/products',          [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Review (must be logged in)
Route::post('/products/{product}/review', [ProductController::class, 'review'])
     ->middleware('auth')
     ->name('products.review');

/*
|----------------------------------------------------------
| ADMIN ROUTES
|----------------------------------------------------------
*/
Route::prefix('admin')
     ->name('admin.')
     ->middleware(['auth', 'admin'])
     ->group(function () {

    Route::get('/', fn() => redirect()->route('admin.products.index'));

    // Products CRUD
    Route::resource('products',   AdminProductController::class);
    Route::delete('images/{image}', [AdminProductController::class, 'destroyImage'])
         ->name('images.destroy');

    // Categories CRUD
    Route::resource('categories', AdminCategoryController::class);
});

require __DIR__.'/auth.php';