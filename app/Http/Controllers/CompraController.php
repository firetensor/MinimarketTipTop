<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\detalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\tempoCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('detalles.producto')->get();
        return view('compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $compras = Compra::all();
        $productos = Producto::all();
        $proveedores = Proveedor::all();

        $session_id = session()->getId();
        $tempo_compras = tempoCompra::where('session_id', $session_id)->get();
        return view('compras.create', compact('productos', 'proveedores', 'tempo_compras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha'=>'required',
            'comprobante'=>'required',
            'precio_total'=>'required',
        ]);

        $session_id = session()->getId();

        $compra = new Compra();
        $compra->fecha=$request->fecha;
        $compra->comprobante = $request->comprobante;
        $compra->precio_total = $request->precio_total;
        $compra->save();

        $tempo_compras = TempoCompra::where('session_id', $session_id)->get();

        foreach ($tempo_compras as $tempo_compra){
            $producto =Producto::where('id', $tempo_compra->id_producto)->first();
            $detalle_compra = new detalleCompra();
            $detalle_compra->cantidad = $tempo_compra->cantidad;
            $detalle_compra->precio_compra = $producto->precio_compra;
            $detalle_compra->id_compra = $compra->id;
            $detalle_compra->id_producto = $tempo_compra->id_producto;
            $detalle_compra->id_proveedor = $request->proveedor_id;
            $detalle_compra->save();

            $producto->stock += $tempo_compra->cantidad;
            $producto->save();

        }
        TempoCompra::where('session_id', $session_id)->delete();

        return redirect()->route('compra.index')
            ->with('mensaje', 'Compra registrada exitosamente')
            ->with('icono', 'success');
    }

    public function show($id)
    {
        $compra = Compra::with('detalles', 'proveedor')->findOrFail($id);
        return view('compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $compra = Compra::with('detalles', 'proveedor')->findOrFail($id);
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('compras.edit', compact('compra', 'proveedores', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        //
    }


}
