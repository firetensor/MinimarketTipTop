<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\tempoOrden;
use Illuminate\Http\Request;

class TempoOrdenController extends Controller
{
    public function tempo_orden(Request $request)
    {
        $producto =Producto::where('codigo', $request->codigo)->first();
        $session_id = session()->getId();

        if($producto){

            $tempo_orden_existe = tempoOrden::where('id_producto', $producto->id)
            ->where('session_id', $session_id)
            ->first();

            if($tempo_orden_existe){
                $tempo_orden_existe->cantidad += $request->cantidad;
                $tempo_orden_existe->save();
                return response()->json(['success'=>true, 'message'=>'El producto fue encontrado']);
            }else{

            $tempo_compra=new tempoOrden();
            $tempo_compra->cantidad=$request->cantidad;
            $tempo_compra->id_producto = $producto->id;
            $tempo_compra->session_id = $session_id;
            $tempo_compra->save();
            return response()->json(['success'=>true, 'message'=>'El producto fue encontrado']);
            }


        }else{
        return response()->json(['success'=>false, 'message'=>'Producto no encontrado']);
        }
    }

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(tempoOrden $tempoOrden)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tempoOrden $tempoOrden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tempoOrden $tempoOrden)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tempoOrden = TempoOrden::find($id);

        if ($tempoOrden) {
            $tempoOrden->delete();
            return response()->json(['success' => true, 'message' => 'Producto eliminado correctamente.']);
        }

        return response()->json(['success' => false, 'message' => 'Producto no encontrado.']);
    }
}
