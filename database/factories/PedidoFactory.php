<?php
// database/factories/PedidoFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(), // o usa uno existente
            'estado' => $this->faker->randomElement(['pendiente', 'enviado', 'entregado']),
            'total' => $this->faker->randomFloat(2, 20, 200),
            'fecha_pedido' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
