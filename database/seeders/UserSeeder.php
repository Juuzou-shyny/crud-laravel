<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crea 20 usuarios normales usando la factory
        User::factory(20)->create();

        // Crea un usuario administrador manualmente
        User::create([ // Debe funcionar si el modelo está bien configurado
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Contraseña cifrada
            'is_admin' => true,
        ]);
    }
}
