<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cuidado;

class CuidadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cuidados = [
            ['nombre' => 'Riego frecuente', 'descripcion' => 'Regar varias veces por semana'],
            ['nombre' => 'Riego moderado', 'descripcion' => 'Regar una vez a la semana'],
            ['nombre' => 'Riego bajo', 'descripcion' => 'Regar cada dos semanas o menos'],
            ['nombre' => 'Luz directa', 'descripcion' => 'Colocar la planta donde reciba luz solar directa'],
            ['nombre' => 'Luz indirecta', 'descripcion' => 'Colocar en un lugar luminoso sin sol directo'],
            ['nombre' => 'Fertilización mensual', 'descripcion' => 'Agregar fertilizante una vez al mes'],
            ['nombre' => 'No necesita fertilizante', 'descripcion' => 'No requiere fertilizante adicional'],
            ['nombre' => 'Alta humedad', 'descripcion' => 'Mantener en ambientes húmedos'],
            ['nombre' => 'Poda regular', 'descripcion' => 'Requiere podas para mantenerse saludable'],
            ['nombre' => 'Dificultad alta', 'descripcion' => 'Requiere atención constante y cuidados específicos'],
        ];

        foreach ($cuidados as $cuidado) {
            Cuidado::create($cuidado);
        }
    }
}
