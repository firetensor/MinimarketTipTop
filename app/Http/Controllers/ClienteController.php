<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        //$clientes = Cliente::all();
        $clientes = Cliente::where('estadocliente','=',1)->get();
        return view('clientes.index', compact('clientes'));
    }

    public function store(Request $request)
{
    // Validar los datos
    $request->validate([
        'nombre_cliente' => 'required|string|max:255',
        'dni_ruc' => 'required|numeric',
        'telefono' => 'required|numeric',
        'email' => 'required|email|max:255',
    ]);

    // Crear un nuevo cliente
    Cliente::create([
        'nombre_cliente' => $request->nombre_cliente,
        'dni_ruc' => $request->dni_ruc,
        'telefono' => $request->telefono,
        'email' => $request->email,
        'estadocliente' => '1',
    ]);

    // Redirigir de nuevo al listado de clientes con un mensaje de éxito
    return redirect()->route('cliente.index')->with('success', 'Cliente registrado exitosamente');
}

public function update(Request $request, $id)
{
    $cliente = Cliente::find($id);
    $cliente->nombre_cliente = $request->nombre_cliente;
    $cliente->dni_ruc = $request->dni_ruc;
    $cliente->telefono = $request->telefono;
    $cliente->email = $request->email;
    $cliente->save();

    return redirect()->route('cliente.index')->with('success', 'Cliente actualizado correctamente.');
}

public function destroy($id)
{
    $cliente = Cliente::findOrFail($id);
    //$cliente->delete();
    $cliente->estadocliente = 0;
        $cliente->save();

    return redirect()->route('cliente.index')->with('success', 'Cliente eliminado con éxito.');
}



}
