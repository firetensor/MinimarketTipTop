<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $ventas = Venta::all();
        $numeroVenta = Venta::count() + 1;
        return view('ventas.create', compact('ventas', 'numeroVenta'));
    }

}
