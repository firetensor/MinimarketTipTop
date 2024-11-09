<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        // Deshabilitar las restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Eliminar todos los registros y resetear el contador del ID
        DB::table('clientes')->truncate();

        $clientes = [
            ['nombre_cliente' => 'Juan Pérez Quispe', 'dni_ruc' => '20123456789', 'telefono' => '912345678', 'email' => 'juan.perez@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'María López García', 'dni_ruc' => '20987654321', 'telefono' => '923456789', 'email' => 'maria.lopez@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Carlos Ramos Fernández', 'dni_ruc' => '20123456701', 'telefono' => '934567890', 'email' => 'carlos.ramos@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Rosa Delgado Martínez', 'dni_ruc' => '20987654302', 'telefono' => '945678901', 'email' => 'rosa.delgado@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'José Castillo Romero', 'dni_ruc' => '20123456703', 'telefono' => '956789012', 'email' => 'jose.castillo@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Luis Mendoza Salazar', 'dni_ruc' => '20987654304', 'telefono' => '967890123', 'email' => 'luis.mendoza@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Ana Chávez Morales', 'dni_ruc' => '20123456705', 'telefono' => '978901234', 'email' => 'ana.chavez@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Pedro Torres Herrera', 'dni_ruc' => '20987654306', 'telefono' => '989012345', 'email' => 'pedro.torres@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Carmen Vega Ríos', 'dni_ruc' => '20123456707', 'telefono' => '912301234', 'email' => 'carmen.vega@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Diego Silva Huerta', 'dni_ruc' => '20987654308', 'telefono' => '923412345', 'email' => 'diego.silva@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Elena Cruz Flores', 'dni_ruc' => '12345678', 'telefono' => '934512345', 'email' => 'elena.cruz@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Julio Paredes Guzmán', 'dni_ruc' => '87654321', 'telefono' => '945623456', 'email' => 'julio.paredes@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Sonia Rojas Salinas', 'dni_ruc' => '13579246', 'telefono' => '956734567', 'email' => 'sonia.rojas@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Andrés López Castillo', 'dni_ruc' => '86420975', 'telefono' => '967845678', 'email' => 'andres.lopez@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Gabriela Martínez Ramos', 'dni_ruc' => '15736924', 'telefono' => '978956789', 'email' => 'gabriela.martinez@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Alejandro Sánchez Valdez', 'dni_ruc' => '82736419', 'telefono' => '989067890', 'email' => 'alejandro.sanchez@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Natalia Torres Rosales', 'dni_ruc' => '19283746', 'telefono' => '912178901', 'email' => 'natalia.torres@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Manuel Reyes García', 'dni_ruc' => '81726345', 'telefono' => '923289012', 'email' => 'manuel.reyes@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Pilar Vela Ugarte', 'dni_ruc' => '14253647', 'telefono' => '934390123', 'email' => 'pilar.vela@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Felipe Díaz Pérez', 'dni_ruc' => '82937461', 'telefono' => '945401234', 'email' => 'felipe.diaz@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Silvia Morales Quiroz', 'dni_ruc' => '13571357', 'telefono' => '956512345', 'email' => 'silvia.morales@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Jorge Guerrero Luna', 'dni_ruc' => '86420973', 'telefono' => '967623456', 'email' => 'jorge.guerrero@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Marta Ruiz Olivares', 'dni_ruc' => '18273645', 'telefono' => '978734567', 'email' => 'marta.ruiz@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Ricardo Gómez Fernández', 'dni_ruc' => '82746319', 'telefono' => '989845678', 'email' => 'ricardo.gomez@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Valeria Rojas Molina', 'dni_ruc' => '19485736', 'telefono' => '912956789', 'email' => 'valeria.rojas@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Lucía Ramírez Escalante', 'dni_ruc' => '13475263', 'telefono' => '923067890', 'email' => 'lucia.ramirez@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'César Ramos Salazar', 'dni_ruc' => '82641739', 'telefono' => '934178901', 'email' => 'cesar.ramos@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Daniela Calderón Vílchez', 'dni_ruc' => '15483927', 'telefono' => '945289012', 'email' => 'daniela.calderon@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Víctor Huamán Huerta', 'dni_ruc' => '26591365', 'telefono' => '956490123', 'email' => 'victor.huaman@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Carlos Peña Martínez', 'dni_ruc' => '12398746', 'telefono' => '967601234', 'email' => 'carlos.pena@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Jessica Vásquez Soto', 'dni_ruc' => '23987465', 'telefono' => '978712345', 'email' => 'jessica.vasquez@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Marco Navarro Silva', 'dni_ruc' => '87654322', 'telefono' => '989823456', 'email' => 'marco.navarro@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Sandra Aguilar Jara', 'dni_ruc' => '19283745', 'telefono' => '912934567', 'email' => 'sandra.aguilar@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Raúl Castro Rosas', 'dni_ruc' => '82736491', 'telefono' => '923045678', 'email' => 'raul.castro@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Nicolás Fernández Soto', 'dni_ruc' => '63927485', 'telefono' => '934156789', 'email' => 'nicolas.fernandez@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Fernanda Casas Salinas', 'dni_ruc' => '70457489', 'telefono' => '985741476', 'email' => 'fernanda.casas@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Maria Mendes Ruiz', 'dni_ruc' => '70584741', 'telefono' => '905471587', 'email' => 'maria_30ruiz@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Carlos García Rojas', 'dni_ruc' => '75847410', 'telefono' => '965474254', 'email' => 'carlos.garcia9@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Luis Zapata Perez', 'dni_ruc' => '70857415', 'telefono' => '965474125', 'email' => 'Luis_5zapata@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_cliente' => 'Irvin Mendez García', 'dni_ruc' => '70405874', 'telefono' => '925474147', 'email' => 'irvin69garcia9@gmail.com', 'estadocliente' => true, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('clientes')->insert($clientes);

        // Habilitar las restricciones de claves foráneas nuevamente
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
