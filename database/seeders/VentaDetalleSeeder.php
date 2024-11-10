<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaDetalleSeeder extends Seeder
{
    public function run()
    {
        $ventas = DB::table('ventas')->get();
        $productos = DB::table('productos')->get();

        foreach ($ventas as $venta) {
            // Genera entre 1 y 5 productos por venta
            for ($j = 1; $j <= rand(1, 5); $j++) {
                $producto = $productos->random(); // Elige un producto aleatorio
                DB::table('venta_detalle')->insert([
                    'cantidad' => rand(1, 10), // cantidad aleatoria
                    'id_venta' => $venta->id,
                    'id_producto' => $producto->id,
                    'created_at' => $venta->created_at,
                    'updated_at' => $venta->updated_at,
                    'preciopoducto' => $producto->precio_venta,
                ]);
            }
        }
    }
}
