<?php
// database/seeders/PedidoSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;

class PedidosSeeder extends Seeder
{
    public function run(): void
    {
        Pedido::factory()->count(10)->create();
    }
}
