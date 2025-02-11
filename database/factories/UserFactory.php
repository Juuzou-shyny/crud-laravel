<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Faker\Factory as FakerFactory;


class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {

        $faker = FakerFactory::create('es_ES');

        return [
            'name' => $faker->name, // Genera un nombre aleatorio
            'email' => $faker->unique()->safeEmail, // Genera un correo electrónico único
            'password' => bcrypt('password'), // Contraseña por defecto
            'is_admin' => $faker->boolean(5), // 5% de probabilidad de ser administrador
        ];
    }

    /**
     * Define un estado para un usuario administrador.
     */
    public function admin()
    {
        return $this->state([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);
    }

    protected function newFaker()
    {
        return \Faker\Factory::create('es_ES'); // Usa el idioma español
    }
}
