<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Crear un nuevo pedido
    public function store(Request $request)
{
    $validated = $request->validate([
        'total' => 'required|numeric|min:0',
    ]);

    // Crear el pedido
    $order = Order::create([
        'user_id' => auth()->id(),
        'total' => $validated['total'],
        'status' => 'pending',
    ]);

    // Agregar ítems del carrito al pedido
    foreach (auth()->user()->carts as $cartItem) {
        $order->items()->create([
            'product_id' => $cartItem->product_id,
            'quantity' => $cartItem->quantity,
            'price' => $cartItem->product->price,
        ]);
    }

// TODO: Implementar la limpieza del carrito después de crear el pedido
// auth()->user()->carts()->delete();

    return redirect()->route('orders.index')->with('success', 'Pedido realizado correctamente.');
}
    // Mostrar el historial de pedidos
    public function index()
    {
        $orders = auth()->user()->orders;
        return view('orders.index', compact('orders'));
    }
}
