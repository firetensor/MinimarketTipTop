<?php

namespace App\Exports;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // // Puedes ajustar la consulta si deseas más campos o filtros
        // return Producto::select('id', 'codigo', 'nombre_producto', 'stock', 'precio_compra', 'precio_venta')
        //                ->where('estadoproducto', 1)  // Filtrando productos activos
        //                ->get();

        $data = DB::table('productos as p')
            ->where('p.estadoproducto', '=', 1)
            ->join('categorias as c', 'p.id_categoria', '=', 'c.id')
            ->select(
                'p.id as id',
                'p.codigo as codigo',
                'p.nombre_producto as nombre',
                'c.nombre_categoria as categoria',
                'p.stock as stock',
                DB::raw("ROUND(p.precio_venta / 1.18, 2) as precio_sin_igv"), // Cálculo del precio sin IGV
                DB::raw("ROUND((p.precio_venta / 1.18) * p.stock, 2) as valorizado"), // Valorizado
                'p.precio_compra as preciocompra',
                'p.precio_venta as precioventa'
                
            )
            ->get();
        
        return $data;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Código',
            'Nombre',
            'Categoría',
            'Stock',
            'Precio sin IGV S/',
            'Valorizado S/',
            'Precio de compra S/',
            'Precio de venta S/'
        ];
    }
}
