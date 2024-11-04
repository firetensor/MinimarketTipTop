<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\ordenDetalle;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\tempoOrden;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Barryvdh\DomPDF\Facade\PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordens = Orden::with('detalles.producto')->get();
        return view('orden.index', compact('ordens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuario = Auth::user();
        $estados = ['Pendiente', 'Aprobada', 'Cancelada'];
        $ordens = Orden::all();
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        $session_id = session()->getId();
        $tempo_ordens = tempoOrden::where('session_id', $session_id)->get();
        return view('orden.create', compact('productos', 'proveedores', 'tempo_ordens', 'estados', 'usuario'));
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
            'subtotal'=>'required',
            'igv'=>'required',
            'id_usuario' => 'required',
            'estado' => 'required',
        ]);

        $session_id = session()->getId();
        $orden = new Orden();
        $orden->fecha=$request->fecha;
        $orden->comprobante = $request->comprobante;
        $orden->subtotal = $request->subtotal;
        $orden->igv = $request->igv;
        $orden->precio_total = $request->precio_total;
        $orden->id_usuario = $request->id_usuario;
        $orden->estado = $request->estado;
        $orden->id_proveedor = $request->proveedor_id;
        $orden->save();

        $tempo_ordens = TempoOrden::where('session_id', $session_id)->get();

        foreach ($tempo_ordens as $tempo_orden){
            $producto =Producto::where('id', $tempo_orden->id_producto)->first();
            $detalle_orden = new ordenDetalle();
            $detalle_orden->cantidad = $tempo_orden->cantidad;
            $detalle_orden->id_orden = $orden->id;
            $detalle_orden->id_producto = $tempo_orden->id_producto;
            $detalle_orden->save();
        }
        TempoOrden::where('session_id', $session_id)->delete();

        return redirect()->route('orden.index')
            ->with('mensaje', 'Orden registrada exitosamente')
            ->with('icono', 'success');
    }

    public function descargarPDF($id)
    {
        $orden = Orden::with(['proveedor', 'detalles.producto', 'user'])->findOrFail($id);

        $tempo_orden = TempoOrden::with('producto')->where('session_id', session()->getId())->get();

        $pdf = PDF::loadView('orden.pdf', compact('orden', 'tempo_orden'));
        return $pdf->download("Orden_Compra_{$orden->id}.pdf");
    }


    /**
     * Display the specified resource.
     */
    public function show(Orden $orden)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orden $orden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orden $orden)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orden $orden)
    {
        //
    }
}
