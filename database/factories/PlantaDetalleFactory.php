<?php
namespace Database\Factories;

use App\Models\PlantaDetalle;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlantaDetalleFactory extends Factory
{
    protected $model = PlantaDetalle::class;

    public function definition(): array
    {
        return [
            'tipo' => $this->faker->randomElement(['Interior', 'Exterior']),
            'riego' => $this->faker->randomElement(['Bajo', 'Moderado', 'Alto']),
            'dificultad' => $this->faker->randomElement(['Fácil', 'Media', 'Difícil']),
            'luz' => $this->faker->randomElement(['Directa', 'Indirecta']),
            'fertilizacion' => $this->faker->randomElement(['Semanal', 'Quincenal', 'Mensual', 'No requerida']),
            'tolerancia_invierno' => $this->faker->boolean(),
            'producto_id' => $this->faker->numberBetween(1, 10), // cambia si tienes pocos productos
        ];
    }
}
