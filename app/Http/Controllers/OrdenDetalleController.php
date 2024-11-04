<?php

namespace App\Http\Controllers;

use App\Models\ordenDetalle;
use App\Models\Producto;
use Illuminate\Http\Request;

class OrdenDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required',
            'cantidad' => 'required|integer',
            'id_orden' => 'required|exists:ordens,id',
            'id_proveedor' => 'required|exists:proveedores,idproveedor',  // Aquí también cambiamos
        ]);
            $producto = Producto::where('codigo', $request->codigo)->first();
            $orden_id = $request->id_orden;
            if ($producto) {
                $detalle_orden_existe = OrdenDetalle::where('id_producto', $producto->id)
                    ->where('id_orden', $orden_id)
                    ->first();

                if ($detalle_orden_existe) {
                    $detalle_orden_existe->cantidad += $request->cantidad;
                    $detalle_orden_existe->save();
                    return response()->json(['success' => true, 'message' => 'El producto fue encontrado']);
                } else {
                    $detalle_orden = new OrdenDetalle();
                    $detalle_orden->cantidad = $request->cantidad;
                    $detalle_orden->id_orden = $orden_id;
                    $detalle_orden->id_producto = $producto->id;
                    $detalle_orden->save();
                    return response()->json(['success' => true, 'message' => 'El producto fue encontrado']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(ordenDetalle $ordenDetalle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ordenDetalle $ordenDetalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ordenDetalle $ordenDetalle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ordenDetalle $ordenDetalle)
    {
        //
    }
}
