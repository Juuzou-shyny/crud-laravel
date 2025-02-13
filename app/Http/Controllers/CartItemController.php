<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartItemController extends Controller
{
    // Mostrar los productos en el carrito
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
        return inertia('Cart/Index', ['cartItems' => $cartItems]);
    }

    // Agregar un producto al carrito
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $request->product_id
            ],
            [
                'quantity' => \DB::raw("quantity + {$request->quantity}")
            ]
        );

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    // Eliminar un producto del carrito
    public function destroy(CartItem $cartItem)
    {
        if ($cartItem->user_id === Auth::id()) {
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }
}
