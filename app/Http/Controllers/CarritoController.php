<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedidos;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class CarritoController extends Controller
{

    public function index()
    {
        // 1. Obtener o crear el pedido/carrito activo
        $pedido = Pedido::firstOrCreate([
            'user_id' => Auth::id(),
            'estado' => 'carrito'
        ], [
            'fecha_pedido' => now(),
            'total' => 0,
            'estado' => 'carrito'
        ]);

        // 2. Cargar los ítems con sus productos (si existen)
        $items = DetallePedidos::with('producto')->where('pedido_id', $pedido->id)->get();

        // 3. Preparar datos para Vue de forma segura
        $mappedItems = $items->map(function ($item) {
            return [
                'id' => $item->id,
                'cantidad' => $item->cantidad,
                'producto' => optional($item->producto)->only(['id', 'nombre', 'precio', 'imagen_url']),
            ];
        });

        // 4. Calcular total de forma segura
        $total = $items->sum(fn($item) => $item->cantidad * optional($item->producto)->precio);

        // 5. Devolver datos a la vista
        return Inertia::render('Carrito/Index', [
            'items' => $mappedItems,
            'total' => $total
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        // Obtener o crear el pedido/carrito activo
        $pedido = Pedido::firstOrCreate([
            'user_id' => Auth::id(),
            'estado' => 'carrito'
        ], [
            'fecha_pedido' => now(),
            'total' => 0,
            'estado' => 'carrito'
        ]);

        // Buscar si el producto ya está en el carrito
        $item = DetallePedidos::firstOrNew([
            'pedido_id' => $pedido->id,
            'producto_id' => $request->producto_id
        ], [
            'cantidad' => 0
        ]);

        // 👇 Cargamos el producto del item o lo buscamos directamente
        $producto = Producto::findOrFail($request->producto_id);

        if ($item->cantidad + $request->cantidad > $producto->stock) {
            return back()->withErrors(['error' => 'No hay suficiente stock disponible']);
        }

        $item->cantidad += $request->cantidad;
        $item->subtotal = $item->cantidad * $producto->precio;
        $item->save(); // Esto guardará también el nuevo item si no existía

        return back()->with('message', 'Producto añadido al carrito');
    }

    public function update(Request $request, DetallePedidos $item)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        $item->update([
            'cantidad' => $request->cantidad,
            'subtotal' => $request->cantidad * $item->producto->precio
        ]);

        return redirect()->back();
    }

    public function destroy(DetallePedidos $item)
    {
        $item->delete();
        return redirect()->back();
    }



    public function checkout()
    {
        // Obtener el carrito activo
        $pedido = Pedido::where('user_id', Auth::id())
            ->where('estado', 'carrito')
            ->firstOrFail();

        // Cargar los detalles con sus productos
        $pedido->load('detallesPedido');

        // Validar que tenga productos
        if ($pedido->detallesPedido->isEmpty()) {
            return back()->with('error', 'No puedes finalizar un carrito vacío');
        }

        // Calcular total
        $total = $pedido->detallesPedido->sum('subtotal');

        // Actualizar estado
        $pedido->update([
            'estado' => 'pendiente',
            'fecha_pedido' => now(),
            'total' => $total
        ]);

        return redirect()->route('gracias')->with('success', 'Pedido completado con éxito');
    }

    public function agregarProducto(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        // Obtener o crear el pedido/carrito activo
        $pedido = Pedido::firstOrCreate([
            'user_id' => Auth::id(),
            'estado' => 'carrito'
        ], [
            'fecha_pedido' => now(),
            'total' => 0,
            'estado' => 'carrito'
        ]);

        // Buscar si el producto ya está en el carrito
        $item = DetallePedidos::firstOrNew([
            'pedido_id' => $pedido->id,
            'producto_id' => $request->producto_id
        ]);

        // Cargar el producto
        $producto = Producto::findOrFail($request->producto_id);

        if ($item->cantidad + $request->cantidad > $producto->stock) {
            return back()->withErrors(['error' => 'No hay suficiente stock disponible']);
        }

        // Si es nuevo, asignar valores necesarios
        if (!$item->exists) {
            $item->pedido_id = $pedido->id;
            $item->producto_id = $request->producto_id;
            $item->precio_unitario = $producto->precio;
        }

        $item->cantidad += $request->cantidad;
        $item->subtotal = $item->cantidad * $producto->precio;

        $item->save();

        // 👇 Recarga los datos del carrito con Inertia
        return to_route('carrito.index');
    }
}
