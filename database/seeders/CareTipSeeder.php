<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CareTip;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CareTipSeeder extends Seeder
{
    public function run()
    {
        if (Product::count() > 0) {
            CareTip::factory(20)->create();
        } else {
            Log::warning('No se han creado CareTips porque no hay productos en la base de datos.');
        }
    }
}
