<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            'Abarrotes',
            'Lácteos y huevos',
            'Bebidas',
            'Snacks',
            'Golosinas',
            'Limpieza',
            'Cuidado personal',
            'Comida rápida y enlatados',
            'Cuidado de mascotas',
            'Vinos, licores y cervezas'
        ];

        foreach ($categorias as $categoria) {
            DB::table('categorias')->insert([
                'nombre_categoria' => $categoria,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
