<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use Faker\Factory as FakerFactory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $faker = FakerFactory::create('es_ES');
        return [
            'name' => $faker->words(3, true), // Nombre del producto (3 palabras aleatorias)
            'description' => $faker->paragraph, // Descripción aleatoria
            'price' => $faker->randomFloat(2, 10, 1000), // Precio entre 10 y 1000
            'category_id' => \App\Models\Category::all()->random()?->id ?? null, // Categoría aleatoria
            'stock' => $faker->numberBetween(1, 100), // Stock entre 1 y 100
            'status' => $faker->randomElement(['active', 'inactive']), // Estado activo/inactivo
        ];
    }

    protected function newFaker()
    {
        return \Faker\Factory::create('es_ES'); // Usa el idioma español
    }
}
