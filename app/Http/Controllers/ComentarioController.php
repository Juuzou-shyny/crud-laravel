<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
   public function store(Request $request)
{
    // Validación
    $request->validate([
        'producto_id' => 'required|exists:productos,id',
        'contenido' => 'required|string|min:3|max:500'
    ]);

    $user = Auth::user();

    $producto = Producto::findOrFail($request->producto_id);

    // OJO: asegurarte que decodificas el JSON a array
    $comentarios = json_decode($producto->comentarios, true) ?? [];

    $nuevoComentario = [
        'user_id' => $user->id,
        'nombre_usuario' => $user->name,
        'contenido' => $request->contenido,
        'fecha' => now()->toDateTimeString()
    ];

    $comentarios[] = $nuevoComentario;

    $producto->update(['comentarios' => $comentarios]);

    return back();
}

}
