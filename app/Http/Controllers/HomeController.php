<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
{
    // Calcula la cantidad de clientes activos
    $clientesTotal = Cliente::where('estadocliente', 1)->count();

    // Calcula la cantidad de usuarios activos
    $usuariosTotal = User::where('estadousuario', 1)->count();

    // Calcula la cantidad total de stock de productos activos
    $stockTotal = Producto::where('estadoproducto', 1)->sum('stock');

    // Calcula el total a pagar por todas las ventas activas
    $ventaTotal = Venta::where('estadoventa', 1)->sum('total_pagar');

    // Filtro opcional por año, por defecto es el año actual
    $anio = $request->get('anio', date('Y'));

    // Definir los nombres de los meses
    $nombresMeses = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];

    // Ventas por mes (número de ventas y monto total)
    $ventasPorMes = Venta::select(
        DB::raw('MONTH(created_at) as mes'),
        DB::raw('COUNT(*) as num_ventas'),
        DB::raw('SUM(total_pagar) as monto_total')
    )
    ->where('estadoventa', 1) // Si tienes un campo 'estadoventa'
    ->whereYear('created_at', $anio)
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->orderBy('mes')
    ->get();

    // Preparar los datos para los meses (asegurar que todos los meses estén representados)
    $numVentas = [];
    $montosTotales = [];

    foreach (range(1, 12) as $mes) {
        $ventaMes = $ventasPorMes->firstWhere('mes', $mes);
        $numVentas[] = $ventaMes ? $ventaMes->num_ventas : 0;
        $montosTotales[] = $ventaMes ? $ventaMes->monto_total : 0;
    }

    // Retornar la vista con los datos
    return view('home', compact(
        'clientesTotal',
        'usuariosTotal',
        'stockTotal',
        'ventaTotal',
        'nombresMeses',
        'numVentas',
        'montosTotales',
        'anio'
    ));
}


    public function inicio()
    {
        return view('inicio');
    }

    public function salir()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
