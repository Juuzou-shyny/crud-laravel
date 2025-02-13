<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    /**
     * Muestra los productos en el carrito del usuario actual.
     */
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();

        return inertia('Cart/Index', ['cartItems' => $cartItems]);
    }

    /**
     * Agregar un producto al carrito o actualizar la cantidad si ya existe.
     */
    public function add(Product $product): RedirectResponse
    {
        $cartItem = Auth::user()->cartItems()->updateOrCreate(
            ['product_id' => $product->id],
            ['quantity' => \DB::raw('quantity + 1'), 'price' => $product->price]
        );

        return back()->with('success', 'Producto agregado al carrito');
    }

    /**
     * Eliminar un producto del carrito.
     */
    public function remove(Product $product): RedirectResponse
    {
        Auth::user()->cartItems()->where('product_id', $product->id)->delete();

        return back()->with('success', 'Producto eliminado del carrito');
    }

    /**
     * Agregar un producto con cantidad personalizada desde el request.
     */
    public function store(Request $request): RedirectResponse
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
                'quantity' => \DB::raw('quantity + ?', [$request->quantity])
            ]
        );

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    /**
     * Eliminar un producto específico del carrito.
     */
    public function destroy(CartItem $cartItem): RedirectResponse
    {
        if ($cartItem->user_id === Auth::id()) {
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }
}
