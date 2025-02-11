<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CareTip;
use App\Models\Product;
use Faker\Factory as FakerFactory;
class CareTipFactory extends Factory
{
    protected $model = CareTip::class;

    public function definition()
    {
        $faker = FakerFactory::create('es_ES');
        return [
            'product_id' => Product::all()->random()?->id ?? null, // Asigna un producto aleatorio
            'tip' => $faker->sentence(), // Consejo de cuidado aleatorio
        ];
    }

    protected function newFaker()
    {
        return \Faker\Factory::create('es_ES'); // Usa el idioma español
    }
}
