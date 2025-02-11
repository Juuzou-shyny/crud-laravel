<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

Route::resource('productos', ProductController::class)->names([
    'index' => 'productos.index',
    'show' => 'productos.show',
    'store' => 'productos.store',
    'update' => 'productos.update',
    'destroy' => 'productos.destroy',
]);

Route::resource('categorias', CategoryController::class)->names([
    'index' => 'categorias.index',
    'show' => 'categorias.show',
    'store' => 'categorias.store',
    'update' => 'categorias.update',
    'destroy' => 'categorias.destroy',
]);


Route::middleware(['auth'])->group(function () {
    // Agregar producto al carrito
    Route::post('/carrito/agregar/{producto}', [CartController::class, 'add'])->name('carrito.add');

    // Mostrar contenido del carrito
    Route::get('/carrito', [CartController::class, 'index'])->name('carrito.index');

    // Eliminar producto del carrito
    Route::delete('/carrito/eliminar/{carrito}', [CartController::class, 'remove'])->name('carrito.remove');

    // Limpiar el carrito
    Route::delete('/carrito/limpiar', [CartController::class, 'clear'])->name('carrito.clear');
});

Route::get('/', function () {
    return view('welcome');
});

// Versión web: Muestra la información en una vista
Route::get('/falta-per-a/{fecha}', function ($fecha) {
    // Convertimos la fecha recibida al formato correcto
    $fechaObjetivo = Carbon::createFromFormat('d-m-Y', $fecha);
    $ahora = Carbon::now();

    // Comprobamos si la fecha ya pasó
    if ($fechaObjetivo->isPast()) {
        return view('falta', ['mensaje' => 'La fecha ya ha pasado.']);
    }

    // Calculamos la diferencia
    $diferencia = $ahora->diff($fechaObjetivo);

    // Generamos el mensaje
    $mensaje = "Falten {$diferencia->y} anys, {$diferencia->m} mesos i {$diferencia->d} dies per a {$fecha}.";

    // Pasamos el mensaje a la vista
    return view('falta', ['mensaje' => $mensaje]);
});

// Versión API: Devuelve la información en JSON
Route::get('/api/falta-per-a/{fecha}', function ($fecha) {
    $fechaObjetivo = Carbon::createFromFormat('d-m-Y', $fecha);
    $ahora = Carbon::now();

    if ($fechaObjetivo->isPast()) {
        return response()->json(['mensaje' => 'La fecha ya ha pasado.']);
    }

    $diferencia = $ahora->diff($fechaObjetivo);

    $mensaje = "Falten {$diferencia->y} anys, {$diferencia->m} mesos i {$diferencia->d} dies per a {$fecha}.";

    return response()->json(['mensaje' => $mensaje]);
});




Route::middleware(['auth'])->group(function () {
    // Crear un nuevo pedido
    Route::post('/pedido', [OrderController::class, 'store'])->name('pedido.store');

    // Ver historial de pedidos
    Route::get('/pedidos', [OrderController::class, 'index'])->name('pedidos.index');

    // Ver detalles de un pedido específico
    Route::get('/pedidos/{pedido}', [OrderController::class, 'show'])->name('pedidos.show');
});



Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Listar todos los usuarios
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');

    // Ver detalles de un usuario específico
    Route::get('/usuarios/{usuario}', [UserController::class, 'show'])->name('usuarios.show');

    // Actualizar un usuario
    Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');

    // Eliminar un usuario
    Route::delete('/usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');
});

Auth::routes();
Route::get('/', [ProductController::class, 'index'])->name('home');

// Fallback route para la versión web
Route::fallback(function () {
    return view('errors.404', [
        'mensaje' => 'La página que buscas no existe. ¿Te gustaría volver al inicio o visitar nuestra página de ayuda?'
    ]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
