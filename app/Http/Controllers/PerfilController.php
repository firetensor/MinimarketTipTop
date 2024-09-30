<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('perfil.index');
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
        try {
        
            //dd($request->all()); // Verifica los datos recibidos
            $validatedData = $request->validate([
    
                'name' => 'required|string|max:255',
                'tipodocumentouser' => 'nullable|string|max:1',
                'nrodocumentouser' => 'nullable|string|max:20',
                'fechanacimientouser' => 'nullable|date',
                'sexouser' => 'nullable|string|max:1',
                'celuser' => 'nullable|string|max:15',
                'direccionuser' => 'nullable|string|max:255',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Imagen opcional
            ]);
           // dd($request->all()); 
    
            $user = User::find($request->update_id);
            $user->name = $request->name;
            $user->tipodocumentouser = $request->tipodocumentouser;
            $user->nrodocumentouser = $request->nrodocumentouser;
            if($request->fechanacimientouser != null || $request->fechanacimientouser != 0){
            $user->fechanacimientouser = $request->fechanacimientouser;
            }
            $user->sexouser = $request->sexouser;
            $user->celuser = $request->celuser;
            $user->direccionuser = $request->direccionuser;
    
            if ($request->hasFile('avatar')) {
                // // Verifica si ya existe una imagen anterior y elimínala
                // if ($user->avatar && Storage::exists($user->avatar)) {
                //     Storage::delete($user->avatar);
                // }

                if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                    // Log para depuración
                    Log::info('Intentando eliminar: ' . 'public/' . $user->avatar);
                    
                    // Eliminar la imagen anterior
                    Storage::delete('public/' . $user->avatar);
                } else {
                    Log::info('No se encontró la imagen para eliminar: ' . 'public/' . $user->avatar);
                }


                $avatar = $request->file('avatar');
                $filename = time() . '-' . $avatar->getClientOriginalName();
                
                // Almacenar en storage/app/public/avatares
                $path = $avatar->storeAs('public/avatares', $filename);
                
                // Guardar la ruta para que sea accesible públicamente
                $user->avatar = 'storage/avatares/' . $filename;
            }
    
            // Guardar cambios
            $user->save();
    
           // return response()->json(['success' => 'Datos actualizados exitosamente.']);

           // Devolver datos actualizados
           return response()->json([
            'success' => 'Datos actualizados exitosamente.',
            'perfil' => $user, // Devolver el usuario con los datos actualizados
            'avatar_url' => $user->avatar ? asset($user->avatar) : asset('storage/avatares/placeholder.png'),
        ]);
    
        } catch (\Exception $e) {
            // Atrapar cualquier error y devolverlo como respuesta
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
        
        //dd($request->all()); // Verifica los datos recibidos
        $validatedData = $request->validate([

            'name' => 'required|string|max:255',
            'tipodocumentouser' => 'nullable|string|max:1',
            'nrodocumentouser' => 'nullable|string|max:20',
            'fechanacimientouser' => 'nullable|date',
            'sexouser' => 'nullable|string|max:1',
            'celuser' => 'nullable|string|max:15',
            'direccionuser' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Imagen opcional
        ]);
        dd($request->all()); 

        $user = User::findOrFail($request->update_id);
        $user->name = $request->name;
        $user->tipodocumentouser = $request->tipodocumentouser;
        $user->nrodocumentouser = $request->nrodocumentouser;
        $user->fechanacimientouser = $request->fechanacimientouser;
        $user->sexouser = $request->sexouser;
        $user->celuser = $request->celuser;
        $user->direccionuser = $request->direccionuser;

        // Verificar si se subió un avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = $user->id . '_avatar.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/avatares', $avatarName);
            $user->avatar = $avatarName;
        }

        // Guardar cambios
        $user->save();

        return response()->json(['success' => 'Datos actualizados exitosamente.']);

    } catch (\Exception $e) {
        // Atrapar cualquier error y devolverlo como respuesta
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
