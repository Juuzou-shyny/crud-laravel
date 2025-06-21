<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\PlantaDetalle;
class PlantaDetalleController extends Controller
{

    protected $table = 'planta_detalles';

    /**
     * Display a listing of the resource.
     */


public function index()
{
    $plantas = PlantaDetalle::with(['cuidados', 'categoria'])->get();
    return Inertia::render('Plantas/Index', [
        'plantas' => $plantas
    ]);
}

public function show($id)
{
    $planta = PlantaDetalle::with(['cuidados', 'categoria'])->findOrFail($id);
    return Inertia::render('Plantas/Show', [
        'planta' => $planta
    ]);
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
