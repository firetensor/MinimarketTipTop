<?php

namespace App\Http\Controllers;

use App\Models\detalleCompra;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleCompraController extends Controller
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
            'id_compra' => 'required|exists:compras,id',
            'id_proveedor' => 'required|exists:proveedores,idproveedor',  // Aquí también cambiamos
        ]);




            $producto = Producto::where('codigo', $request->codigo)->first();
            $compra_id = $request->id_compra;

            if ($producto) {
                $detalle_compra_existe = DetalleCompra::where('id_producto', $producto->id)
                    ->where('id_compra', $compra_id)
                    ->first();

                if ($detalle_compra_existe) {
                    $detalle_compra_existe->cantidad += $request->cantidad;
                    $detalle_compra_existe->save();
                    return response()->json(['success' => true, 'message' => 'El producto fue encontrado']);
                } else {
                    $detalle_compra = new DetalleCompra();
                    $detalle_compra->cantidad = $request->cantidad;
                    //$detalle_compra->precio_compra = $producto->precio_compra;
                    $detalle_compra->id_compra = $compra_id;
                    $detalle_compra->id_producto = $producto->id;
                    //$detalle_compra->id_proveedor = $request->id_proveedor;
                    $detalle_compra->save();
                    return response()->json(['success' => true, 'message' => 'El producto fue encontrado']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
            }

    }

    /**
     * Display the specified resource.
     */
    public function show(detalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DetalleCompra::destroy($id);
        return response()->json(['success'=>true]);
    }
}
