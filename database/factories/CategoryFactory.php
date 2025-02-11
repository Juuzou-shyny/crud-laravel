<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $faker = FakerFactory::create('es_ES'); // Cambiar Faker a español

        $name = $faker->unique()->word(); // Generar nombre único para la categoría

        return [
            'name' => ucfirst($name), // Nombre con primera letra en mayúscula
            'slug' => Str::slug($name . '-' . $faker->unique()->randomNumber()), // Slug único
            'description' => $faker->sentence(), // Descripción en español
        ];
    }

    protected function newFaker()
    {
        return \Faker\Factory::create('es_ES'); // Usa el idioma español
    }
}
