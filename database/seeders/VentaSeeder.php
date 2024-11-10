<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VentaSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 900; $i++) {
            // Establece la fecha de inicio como 1 de enero de 2024 y la fecha de finalización como la fecha actual
            $fechaInicio = Carbon::create(2024, 1, 1);
            $fechaHoy = Carbon::now();

            // Calcula el número de días entre la fecha de inicio y hoy
            $diasDiferencia = $fechaInicio->diffInDays($fechaHoy);

            // Genera una fecha aleatoria dentro del rango
            $fecha = $fechaInicio->copy()->addDays(rand(0, $diasDiferencia));

            DB::table('ventas')->insert([
                'total_pagar' => rand(0.70, 200), // total aleatorio entre 0.70 y 200
                'id_cliente' => rand(1, 40), // suponiendo que tienes 40 clientes
                'created_at' => $fecha,
                'updated_at' => $fecha,
                'idusuario' => rand(1, 4), // suponiendo que tienes 4 usuarios
                'estadoventa' => rand(0, 1), // 0 o 1 para el estado de la venta
            ]);
        }
    }
}

