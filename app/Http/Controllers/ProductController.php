<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
   // Mostrar todos los productos
   public function index()
   {
       $products = Product::all();
       return view('products.index', compact('products'));
   }

 // Agregar un nuevo producto
 public function store(Request $request)
 {
     $validated = $request->validate([
         'name' => 'required|string|max:255',
         'description' => 'nullable|string',
         'price' => 'required|numeric|min:0',
         'category_id' => 'required|exists:categories,id',
     ]);

     Product::create($validated);

     return redirect()->route('products.index')->with('success', 'Producto agregado correctamente.');
 }

    // Actualizar un producto
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar un producto
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }


}
