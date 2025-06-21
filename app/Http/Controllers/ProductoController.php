<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Inertia\Inertia;
  use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    /**
     * Muestra la página principal con plantas y productos destacados.
     */

public function index()
{
    // Obtener datos
    $featuredPlants = Producto::has('detallesPlanta')->take(4)->get();
    $featuredProducts = Producto::doesntHave('detallesPlanta')->take(4)->get();

    // Datos adicionales (para el layout)
    $canLogin = Route::has('login');
    $canRegister = Route::has('register');
    $laravelVersion = Application::VERSION;
    $phpVersion = PHP_VERSION;

    return Inertia::render('Home', compact(
        'featuredPlants',
        'featuredProducts',
        'canLogin',
        'canRegister',
        'laravelVersion',
        'phpVersion'
    ));
}

    /**
     * Muestra todas las plantas.
     */
public function indexPlantas()
{
    $plantas = Producto::has('detallesPlanta')->get();

    return Inertia::render('Plantas/Index', [
        'plantas' => $plantas
    ]);
}

    /**
     * Muestra una planta específica.
     */


public function showPlanta(Producto $producto)
{
    // Carga la planta con sus detalles de cuidado
    $planta = $producto->load('detallesPlanta');

    return Inertia::render('Plantas/Show', [
        'planta' => $planta
    ]);
}

    /**
     * Muestra todos los productos.
     */
public function indexProductos()
{
    $productos = Producto::doesntHave('detallesPlanta')->get();

    return Inertia::render('Productos/Index', [
        'productos' => $productos
    ]);
}

    /**
     * Muestra un producto específico.
     */
public function showProducto(Producto $producto)
{
    return Inertia::render('Productos/Show', [
        'producto' => $producto
    ]);
}
}
