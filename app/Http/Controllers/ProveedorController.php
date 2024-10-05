<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users=User::all();
        if ($request->ajax()) {
			$data = DB::table('proveedores as p')
            ->where('p.estadoproveedor','=',1)
			->select('p.*')
			->get();
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action1', function ($row) {
                    $btn = '<a data-toggle="tooltip"  data-id="' . $row->idproveedor . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProveedor" ><i class="fa fa-edit"></i></a>';
                    return $btn;
                })
                ->addColumn('action2', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->idproveedor . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProveedor"><i class="fa fa-trash"></i></a>';

                    return $btn;
                })
                ->addColumn('action3', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->idproveedor . '" data-original-title="Ver" class="btn btn-warning btn-sm eyeProveedor"><i class="fa fa-eye" aria-hidden="true"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action1','action2','action3'])
                ->make(true);
        }
        return view('proveedores.index', compact('users'));
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
        $query=Proveedor::where('nrodocumentoproveedor','=',$request->get('nrodocumentoproveedor'))->get();
        if($query->count()!=0) //si lo encuentra, osea si no esta vacia
        {
            
            //return response()->json(['error' => 'Proveedor ya registrado'], 401);      
            return response()->json([
                'errors' => ['nrodocumentoproveedor' => ['Nro de documento ya existe']],
                'input' => $request->only('nombresproveedor','celularproveedor','tipodocumentoproveedor',
                'correoproveedor','direccionproveedor')  // Retorna valores ingresados
            ], 422);             
        }
        else{
            $proveedor = new Proveedor();
            $proveedor->nombresproveedor = $request->nombresproveedor;
            $proveedor->celularproveedor = $request->celularproveedor;
            $proveedor->tipodocumentoproveedor = $request->tipodocumentoproveedor;
            $proveedor->correoproveedor = $request->correoproveedor;
            $proveedor->nrodocumentoproveedor = $request->nrodocumentoproveedor;
            $proveedor->direccionproveedor = $request->direccionproveedor;
            date_default_timezone_set('America/Lima');		
                $fecha_actual = date("Y-m-d H:i:s"); 
            $proveedor->fecharegistroproveedor = $fecha_actual;
            $proveedor->fechaupdateproveedor = $fecha_actual;
            $proveedor->estadoproveedor = 1;
            $proveedor->id = $request->id;

            $proveedor->save();
            //return redirect()->route('permiso.index')->with('datos','Prrmisos agregado con todos los permisos ...!');

            return response()->json(['success' => 'Proveedor Registrado Exitosamente!',compact('proveedor')]);
            
            
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proveedor = Proveedor::find($id);
        $usuario=User::find($proveedor->id);
        
        return response()->json(['data' => $proveedor,'data2' => $usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proveedor = Proveedor::find($id);
        
        return response()->json(['data' => $proveedor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->nombresproveedor = $request->nombresproveedor;
        $proveedor->celularproveedor = $request->celularproveedor;
        $proveedor->correoproveedor = $request->correoproveedor;
        $proveedor->direccionproveedor = $request->direccionproveedor;
        date_default_timezone_set('America/Lima');		
            $fecha_actual = date("Y-m-d H:i:s"); 
        $proveedor->fechaupdateproveedor = $fecha_actual;
        $proveedor->id = $request->id;


		$proveedor->update();

        return response()->json(['success' => 'Proveedor actualizado exitosamente.',compact('proveedor')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->estadoproveedor = 0;
        $proveedor->save();

        return response()->json(['success' => 'Proveedor Eliminado Exitosamente.']);
    }
}
