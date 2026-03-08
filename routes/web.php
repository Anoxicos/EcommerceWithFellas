<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Public\ProductController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminUserController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register',  [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login',     [LoginController::class, 'showForm'])->name('login');
    Route::post('/login',    [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
     ->middleware('auth')
     ->name('logout');

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products',           [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::post('/products/{product}/review', [ProductController::class, 'storeReview'])
     ->middleware('auth')
     ->name('products.review');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
     ->name('admin.')
     ->middleware(['auth', 'admin'])
     ->group(function () {

    Route::get('/', fn() => redirect()->route('admin.products.index'))->name('dashboard');

    Route::resource('products',   AdminProductController::class);
    Route::delete('images/{image}', [AdminProductController::class, 'destroyImage'])
         ->name('images.destroy');

    Route::resource('categories', AdminCategoryController::class);

    Route::get('users',                         [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}/role',           [AdminUserController::class, 'updateRole'])->name('users.role');
    Route::patch('users/{user}/toggle-suspend', [AdminUserController::class, 'toggleSuspend'])->name('users.suspend');
});