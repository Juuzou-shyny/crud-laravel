<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\CareTip;

class CareTipSeeder extends Seeder
{
    public function run()
    {
        // Obtener productos solo de las categorías 4 y 5
        $products = Product::whereIn('category_id', [4, 5])->get();

        foreach ($products as $product) {
            CareTip::create([
                'product_id' => $product->id,
                'watering' => 'Riego moderado, cada 2-3 días',
                'sunlight' => 'Luz indirecta brillante',
                'temperature' => '18-25°C',
            ]);
        }
    }
}
