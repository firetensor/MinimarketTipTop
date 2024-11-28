<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
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

    public function home()
    {
        // Calcula la cantidad de clientes activos
        $clientesTotal = Cliente::where('estadocliente', 1)->count();

        // Calcula la cantidad de usuarios
        $usuariosTotal = User::where('estadousuario', 1)->count();

        $stockTotal = Producto::where('estadoproducto', 1)->sum('stock');

        $ventaTotal = Venta::where('estadoventa', 1)->sum('total_pagar');

        // Retorna la vista 'home' con los datos de clientes y usuarios
        return view('home', compact('clientesTotal', 'usuariosTotal', 'stockTotal', 'ventaTotal'));
    }


}
