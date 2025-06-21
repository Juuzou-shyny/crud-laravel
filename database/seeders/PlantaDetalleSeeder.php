<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\PlantaDetalle;

class PlantaDetalleSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener solo productos cuya categoría sea 'Plantas'
        $productosPlantas = Producto::whereHas('categoria', function ($query) {
            $query->where('nombre', 'Plantas');
        })->get();

        foreach ($productosPlantas as $producto) {
            PlantaDetalle::factory()->create([
                'producto_id' => $producto->id,
            ]);
        }
    }
}
