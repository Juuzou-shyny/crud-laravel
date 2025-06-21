<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $this->call([
            CuidadosSeeder::class,
            CategoriaSeeder::class,
            ProductoSeeder::class,
            PlantaDetalleSeeder::class,
            PedidosSeeder::class,
            DetallePedidosSeeder::class,
            CuidadoPlantaSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

}
