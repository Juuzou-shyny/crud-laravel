<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Crea 10 categorías aleatorias
        Category::factory(10)->create();
    }
}
