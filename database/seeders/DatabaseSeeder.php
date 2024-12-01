<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            ClienteSeeder::class,
            CategoriaSeeder::class,
            ProveedorSeeder::class,
            ProductoSeeder::class,
            VentaSeeder::class,
            VentaDetalleSeeder::class,
        ]);
    }

}
