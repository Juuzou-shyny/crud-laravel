<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Agregar un producto al carrito
    public function add(Request $request, Product $product)
    {
        $cartItem = Cart::firstOrNew([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        $cartItem->quantity += $request->input('quantity', 1);
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito.');
    }

    // Mostrar el contenido del carrito
    public function index()
    {
        $cartItems = auth()->user()->carts;
        return view('carts.index', compact('cartItems'));
    }

    // Eliminar un producto del carrito
    public function remove(Cart $cart)
    {
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    }
}
