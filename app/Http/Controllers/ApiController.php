<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    // Método para obtener información temporal
    public function info()
    {
        return response()->json([
            'mensaje' => 'Esta es una API de prueba. La implementación real estará disponible próximamente.',
            'estado' => 'API en desarrollo',
            'version' => '1.0.0'
        ]);
    }

    // Método para simular un listado de elementos
    public function list()
    {
        return response()->json([
            ['id' => 1, 'nombre' => 'Elemento 1', 'descripcion' => 'Descripción del elemento 1'],
            ['id' => 2, 'nombre' => 'Elemento 2', 'descripcion' => 'Descripción del elemento 2'],
            ['id' => 3, 'nombre' => 'Elemento 3', 'descripcion' => 'Descripción del elemento 3'],
        ]);
    }

    // Método para simular un detalle de un elemento
    public function show($id)
    {
        return response()->json([
            'id' => $id,
            'nombre' => "Elemento {$id}",
            'descripcion' => "Descripción del elemento {$id}",
        ]);
    }

    // Método para un mensaje temporal al intentar crear algo
    public function store(Request $request)
    {
        return response()->json([
            'mensaje' => 'Funcionalidad temporal. El elemento no ha sido creado.',
            'datos_recibidos' => $request->all()
        ], 201);
    }
}
