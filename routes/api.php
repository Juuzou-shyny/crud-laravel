<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CareTipController;


Route::get('/caretips', [CareTipController::class, 'index']);
Route::post('/caretips', [CareTipController::class, 'store']);
Route::get('/caretips/{id}', [CareTipController::class, 'show']);
Route::put('/caretips/{id}', [CareTipController::class, 'update']);
Route::delete('/caretips/{id}', [CareTipController::class, 'destroy']);


Route::apiResource('/plants', ProductController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/care-tips', CareTipController::class);


Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);



// Ruta para obtener información temporal
Route::get('/info', [ApiController::class, 'info']);

// Ruta para simular un listado de elementos
Route::get('/elementos', [ApiController::class, 'list']);

// Ruta para mostrar los detalles de un elemento específico
Route::get('/elementos/{id}', [ApiController::class, 'show']);

// Ruta para simular la creación de un elemento
Route::post('/elementos', [ApiController::class, 'store']);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Fallback route para la versión API
Route::fallback(function () {
    return response()->json([
        'error' => 'Ruta no válida',
        'mensaje' => 'La ruta que intentaste acceder no existe. Verifica la URL o consulta la documentación.'
    ], 404);
});
