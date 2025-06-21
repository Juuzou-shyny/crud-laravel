<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Plantas',
            'Macetas',
            'Herramientas',
            'Sustratos',
            'Accesorios'
        ];

        foreach ($categorias as $nombre) {
            Categoria::create([
                'nombre' => $nombre,
                'descripcion' => 'Categoría de ' . strtolower($nombre),
            ]);
        }
    }
}
