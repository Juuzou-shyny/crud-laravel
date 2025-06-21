<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlantaDetalle;
use App\Models\Cuidado;
use Illuminate\Support\Facades\DB;

class CuidadoPlantaSeeder extends Seeder
{
    public function run(): void
    {
        $plantas = PlantaDetalle::all();
        $cuidados = Cuidado::all();

        foreach ($plantas as $planta) {
            // Asignar entre 1 y 3 cuidados aleatorios a cada planta
            $cuidadosAleatorios = $cuidados->random(rand(1, 3));

            foreach ($cuidadosAleatorios as $cuidado) {
                DB::table('cuidado_planta')->insert([
                    'planta_detalle_id' => $planta->id,
                    'cuidado_id' => $cuidado->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
