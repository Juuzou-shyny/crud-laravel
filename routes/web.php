<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartItemController;

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartItemController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartItemController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cartItem}', [CartItemController::class, 'destroy'])->name('cart.destroy');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        if (Gate::denies('admin-access')) {
            abort(403, 'Acceso denegado. No eres administrador.');
        }
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');
});


Route::middleware(['auth'])->group(function () {
    // Listado de productos con ProductController@index ✅
    Route::get('/productos', [ProductController::class, 'index'])->name('productos.index');
    Route::get('/productos/{id}', [ProductController::class, 'show'])->name('productos.show');
    Route::post('/productos', [ProductController::class, 'store'])->name('productos.store');
    Route::put('/productos/{id}', [ProductController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{id}', [ProductController::class, 'destroy'])->name('productos.destroy');

    // Listado de categorías
    Route::get('/categories', function () {
        return Inertia::render('Categories/Index');
    })->name('categories.index');

    Route::get('/categories/{id}', function ($id) {
        return Inertia::render('Categories/Show', ['id' => $id]);
    })->name('categories.show');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
