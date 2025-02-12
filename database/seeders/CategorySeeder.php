<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Herramientas', 'image' => 'herramientas.jpg'],
            ['name' => 'Macetas', 'image' => 'macetas.jpg'],
            ['name' => 'Sustrato', 'image' => 'sustrato.jpg'],
            ['name' => 'Plantas de Interior', 'image' => 'plantas-interior.jpg'],
            ['name' => 'Plantas de Exterior', 'image' => 'plantas-exterior.jpg'],
            ['name' => 'Gravas', 'image' => 'gravas.jpg'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => 'Descripción de ' . $category['name'],
                'image' => $category['image'],
            ]);
        }
    }

}
