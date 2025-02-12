<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;




class CategoryController extends Controller
{

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    // Generar slug automáticamente
    $validated['slug'] = Str::slug($validated['name']);

    Category::create($validated);

    return redirect()->route('categories.index')->with('success', 'Categoría agregada correctamente.');
}




public function update(Request $request, Category $category)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    // Actualizar slug si cambia el nombre
    $validated['slug'] = Str::slug($validated['name']);

    $category->update($validated);

    return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente.');
}


public function index()
{
    $categories = Category::all()->map(function ($category) {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'image' => asset('images/categories/' . $category->image), // Genera la URL completa
        ];
    });

    return response()->json($categories);
}



public function show($id)
{
    $category = Category::findOrFail($id);

    // Si la categoría es "Plantas de Interior" (ID: 4) o "Plantas de Exterior" (ID: 5), incluir caretips
    if (in_array($category->id, [4, 5])) {
        $products = $category->products()->with('caretip')->get();
    } else {
        $products = $category->products()->get(); // No cargar caretips en otras categorías
    }

    return response()->json([
        'category' => $category,
        'products' => $products,
    ]);
}




}
