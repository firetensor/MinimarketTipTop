<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public function index()
    {
        // Cargar las relaciones producto, proveedor y usuario
        $compras = Compra::with(['producto', 'proveedor', 'usuario'])->get();
        $nro_compra = Compra::count() + 1;
        return view('compras.index', compact('compras', 'nro_compra'));
    }

    public function create()
    {
        $compras = Compra::all(); // Obtiene las compras
        $productos = Producto::all(); // Obtiene los productos
        $proveedores = Proveedor::all(); // Obtiene los productos
        $numeroCompra = Compra::count() + 1;
        $id_usuario = Auth::user();

        return view('compras.create', compact('compras', 'productos', 'proveedores', 'numeroCompra', 'id_usuario'));
    }



}
