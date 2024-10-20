<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\tempoCompra;
use Illuminate\Http\Request;

class TempoCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function tempo_compra(Request $request)
    {
        $producto =Producto::where('codigo', $request->codigo)->first();
        $session_id = session()->getId();

        if($producto){

            $tempo_compra_existe = tempoCompra::where('id_producto', $producto->id)
            ->where('session_id', $session_id)
            ->first();

            if($tempo_compra_existe){
                $tempo_compra_existe->cantidad += $request->cantidad;
                $tempo_compra_existe->save();
                return response()->json(['success'=>true, 'message'=>'El producto fue encontrado']);
            }else{

            $tempo_compra=new tempoCompra();
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
    public function show(tempoCompra $tempoCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tempoCompra $tempoCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tempoCompra $tempoCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tempoCompra = TempoCompra::find($id);

        if ($tempoCompra) {
            $tempoCompra->delete();
            return response()->json(['success' => true, 'message' => 'Producto eliminado correctamente.']);
        }

        return response()->json(['success' => false, 'message' => 'Producto no encontrado.']);
    }

}
