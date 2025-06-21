<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;


Route::get('/plantas', [ProductoController::class, 'indexPlantas'])->name('plantas.index');
Route::get('/plantas/{id}', [ProductoController::class, 'showPlanta'])->name('plantas.show');
Route::get('/', [ProductoController::class, 'index'])->name('home');
Route::get('/productos', [ProductoController::class, 'indexProductos'])->name('productos.index');
Route::get('/productos/{id}', [ProductoController::class, 'showProducto'])->name('productos.show');
Route::get('/gracias', function () {
    return Inertia::render('Carrito/Gracias');
})->name('gracias')->middleware('auth');




// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Solo usuarios normales ven sus pedidos
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');

     Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
});

// Ruta para admin para ver todos los pedidos
Route::middleware(['auth'])->get('/admin/pedidos', [PedidoController::class, 'indexAll'])->name('admin.pedidos.index');

Route::middleware(['auth'])->group(function () {
    Route::post('/carrito/agregar', [CarritoController::class, 'agregarProducto'])->name('carrito.agregar');
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');
    Route::put('/carrito/{item}', [CarritoController::class, 'update'])->name('carrito.update');
    Route::delete('/carrito/{item}', [CarritoController::class, 'destroy'])->name('carrito.destroy');
    Route::post('/carrito/checkout', [CarritoController::class, 'checkout'])->name('carrito.checkout');

    Route::resource('pedidos', PedidoController::class)->only(['index', 'show', 'update']);
});


Route::get('/', [ProductoController::class, 'index'])->name('home');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
