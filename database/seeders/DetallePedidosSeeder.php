<?php
// database/seeders/DetallePedidosSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\DetallePedidos;

class DetallePedidosSeeder extends Seeder
{
    public function run(): void
    {
        $pedidos = Pedido::all();
        $productos = Producto::all();

        foreach ($pedidos as $pedido) {
            $productosAleatorios = $productos->random(rand(1, 5));

            foreach ($productosAleatorios as $producto) {
                $cantidad = rand(1, 5);
                $precio = $producto->precio;

                DetallePedidos::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio,
                    'subtotal' => $precio * $cantidad,
                ]);
            }
        }
    }
}
