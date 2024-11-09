<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        $proveedores = [
            ['nombresproveedor' => 'Distribuidora San Fernando', 'celularproveedor' => '987654321', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'contacto@sanfernando.com', 'nrodocumentoproveedor' => '20123456789', 'direccionproveedor' => 'Dirección 1', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Laive', 'celularproveedor' => '912345678', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'info@laive.com', 'nrodocumentoproveedor' => '20234567890', 'direccionproveedor' => 'Dirección 2', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Corporación Lindley', 'celularproveedor' => '998765432', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'ventas@lindley.com', 'nrodocumentoproveedor' => '20345678901', 'direccionproveedor' => 'Dirección 3', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Inca Kola', 'celularproveedor' => '987123456', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'contacto@incakola.com', 'nrodocumentoproveedor' => '20456789012', 'direccionproveedor' => 'Dirección 4', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Nestlé Perú', 'celularproveedor' => '912987654', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'ventas@nestle.com', 'nrodocumentoproveedor' => '20567890123', 'direccionproveedor' => 'Dirección 5', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'San Jorge', 'celularproveedor' => '932123456', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'info@sanjorge.com', 'nrodocumentoproveedor' => '20678901234', 'direccionproveedor' => 'Dirección 6', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'GN', 'celularproveedor' => '945678123', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'contacto@gn.com', 'nrodocumentoproveedor' => '20789012345', 'direccionproveedor' => 'Dirección 7', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'PepsiCo', 'celularproveedor' => '954321789', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'info@pepsico.com', 'nrodocumentoproveedor' => '20890123456', 'direccionproveedor' => 'Dirección 8', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Kimberly-Clark', 'celularproveedor' => '987654123', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'ventas@kimberly-clark.com', 'nrodocumentoproveedor' => '20901234567', 'direccionproveedor' => 'Dirección 9', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Procter & Gamble (P&G)', 'celularproveedor' => '961234567', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'contacto@pg.com', 'nrodocumentoproveedor' => '21012345678', 'direccionproveedor' => 'Dirección 10', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Unilever', 'celularproveedor' => '912345678', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'info@unilever.com', 'nrodocumentoproveedor' => '21123456789', 'direccionproveedor' => 'Dirección 11', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Donofrio', 'celularproveedor' => '987321654', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'contacto@donofrio.com', 'nrodocumentoproveedor' => '21234567890', 'direccionproveedor' => 'Dirección 12', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Costa S.A', 'celularproveedor' => '943218765', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'ventas@costa.com', 'nrodocumentoproveedor' => '21345678901', 'direccionproveedor' => 'Dirección 13', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Gloria S.A.', 'celularproveedor' => '954789321', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'info@gloria.com', 'nrodocumentoproveedor' => '21456789012', 'direccionproveedor' => 'Dirección 14', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Corporación Redondos', 'celularproveedor' => '987123654', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'ventas@redondos.com', 'nrodocumentoproveedor' => '21567890123', 'direccionproveedor' => 'Dirección 15', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Alicorp S.A.A.', 'celularproveedor' => '912987321', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'contacto@alicorp.com', 'nrodocumentoproveedor' => '21678901234', 'direccionproveedor' => 'Dirección 16', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Grupo Bimbo', 'celularproveedor' => '987654987', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'info@bimbo.com', 'nrodocumentoproveedor' => '21789012345', 'direccionproveedor' => 'Dirección 17', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Bacus S.A.', 'celularproveedor' => '921456789', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'ventas@bacus.com', 'nrodocumentoproveedor' => '21890123456', 'direccionproveedor' => 'Dirección 18', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Red Bull GmbH', 'celularproveedor' => '931245678', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'contacto@redbull.com', 'nrodocumentoproveedor' => '21901234567', 'direccionproveedor' => 'Dirección 19', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Tabernero', 'celularproveedor' => '945612378', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'info@tabernero.com', 'nrodocumentoproveedor' => '22012345678', 'direccionproveedor' => 'Dirección 20', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
            ['nombresproveedor' => 'Mars Petcare', 'celularproveedor' => '954987321', 'tipodocumentoproveedor' => 'R', 'correoproveedor' => 'contacto@mars.com', 'nrodocumentoproveedor' => '22123456789', 'direccionproveedor' => 'Dirección 21', 'fecharegistroproveedor' => Carbon::now(), 'fechaupdateproveedor' => Carbon::now(), 'estadoproveedor' => 1],
        ];

        foreach ($proveedores as $proveedor) {
            DB::table('proveedores')->insert($proveedor);
        }
    }
}
