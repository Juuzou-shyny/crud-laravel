<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CareTip;
use App\Models\Product;

class CareTipController extends Controller
{
    /**
     * Mostrar los caretips de productos que pertenecen a categorías 4 y 5 (plantas).
     */
    public function index()
    {
        $caretips = CareTip::whereHas('product', function ($query) {
            $query->whereIn('category_id', [4, 5]);
        })->get();

        return response()->json($caretips);
    }

    /**
     * Guardar un nuevo caretip (solo si el producto es de categoría 4 o 5).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'watering' => 'required|string|max:255',
            'sunlight' => 'required|string|max:255',
            'temperature' => 'required|string|max:255',
        ]);

        // Verificar que el producto pertenece a una categoría de planta
        $product = Product::findOrFail($validated['product_id']);
        if (!in_array($product->category_id, [4, 5])) {
            return response()->json(['error' => 'Solo las plantas pueden tener caretips'], 403);
        }

        $caretip = CareTip::create($validated);
        return response()->json($caretip, 201);
    }

    /**
     * Mostrar un caretip específico.
     */
    public function show($id)
    {
        $caretip = CareTip::findOrFail($id);
        return response()->json($caretip);
    }

    /**
     * Actualizar un caretip (solo si el producto es de categoría 4 o 5).
     */
    public function update(Request $request, $id)
    {
        $caretip = CareTip::findOrFail($id);
        $product = $caretip->product;

        // Verificar que el producto pertenece a una categoría de planta
        if (!in_array($product->category_id, [4, 5])) {
            return response()->json(['error' => 'Solo las plantas pueden tener caretips'], 403);
        }

        $validated = $request->validate([
            'watering' => 'required|string|max:255',
            'sunlight' => 'required|string|max:255',
            'temperature' => 'required|string|max:255',
        ]);

        $caretip->update($validated);
        return response()->json($caretip);
    }

    /**
     * Eliminar un caretip (normalmente se eliminará cuando se elimine una planta).
     */
    public function destroy($id)
    {
        $caretip = CareTip::findOrFail($id);
        $caretip->delete();

        return response()->json(['message' => 'Caretip eliminado correctamente']);
    }
}
