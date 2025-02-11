<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    /**
     * Seed the application's database.
     */
    public function run()
    {

        // Primero creamos categorías
        $this->call(CategorySeeder::class);

        // Luego creamos productos (si tienes un seeder para productos)
        $this->call(ProductSeeder::class);

        // Después creamos usuarios
        $this->call(UserSeeder::class);

        // Finalmente creamos care tips (solo si hay productos disponibles)
        $this->call(CareTipSeeder::class);
    }
}
