<?php
// database/factories/DetallePedidoFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DetallePedidoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pedido_id' => \App\Models\Pedido::factory(), // puede ser reemplazado por un ID real si ya hay pedidos
            'producto_id' => \App\Models\Producto::factory(),
            'cantidad' => $this->faker->numberBetween(1, 5),
            'precio_unitario' => $this->faker->randomFloat(2, 5, 50),
        ];
    }
}
