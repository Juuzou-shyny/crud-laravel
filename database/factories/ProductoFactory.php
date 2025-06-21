<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->words(2, true),
            'descripcion' => $this->faker->sentence(),
            'precio' => $this->faker->randomFloat(2, 5, 100),
            'stock' => $this->faker->numberBetween(5, 50),
            'imagen_url' => $this->faker->imageUrl(640, 480, 'plants', true),
            'categoria_id' => Categoria::inRandomOrder()->first()->id,
        ];
    }
}
