<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\PlantaDetalle;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        // Crear una planta
        $planta = Producto::create([
            'nombre' => 'Planta Interior',
            'descripcion' => 'Ideal para interiores',
            'precio' => 19.99,
            'stock' => 10,
            'imagen_url' => 'https://picsum.photos/200/300?random=1',
            'categoria_id' => 1
        ]);

        PlantaDetalle::create([
            'producto_id' => $planta->id,
            'tipo' => 'Interior',
            'riego' => 'Moderado',
            'luz' => 'Indirecta',
            'dificultad' => 'Media'
        ]);

                $planta = Producto::create([
            'nombre' => 'Planta Exterior',
            'descripcion' => 'Ideal para terrazas y balcones',
            'precio' => 9.99,
            'stock' => 11,
            'imagen_url' => 'https://picsum.photos/200/300?random=1',
            'categoria_id' => 5
        ]);

        PlantaDetalle::create([
            'producto_id' => $planta->id,
            'tipo' => 'Interior',
            'riego' => 'Moderado',
            'luz' => 'Indirecta',
            'dificultad' => 'Media'
        ]);

        // Crear un producto normal
        Producto::create([
            'nombre' => 'Maceta decorativa',
            'descripcion' => 'Maceta de cerámica',
            'precio' => 14.99,
            'stock' => 20,
            'imagen_url' => 'https://picsum.photos/200/300?random=2',
            'categoria_id' => 2
        ]);

             Producto::create([
            'nombre' => 'Sustrato cactus',
            'descripcion' => 'Genial para plantas de poco riego, como los cactus y las suculentas',
            'precio' => 10.99,
            'stock' => 18,
            'imagen_url' => 'https://picsum.photos/200/300?random=2',
            'categoria_id' => 3
        ]);

             Producto::create([
            'nombre' => 'Sustrato tropicales',
            'descripcion' => 'Genial para plantas de mucho riego, como las monteras y las enredaderas',
            'precio' => 10.99,
            'stock' => 18,
            'imagen_url' => 'https://picsum.photos/200/300?random=2',
            'categoria_id' => 4
        ]);
    }
}
