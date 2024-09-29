<?php

namespace App\Http\Controllers;
use App\Models\Categoria;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        // Recupera todas las categorías
        $categorias = Categoria::all();

        // Pasa las categorías a la vista
        return view('categorias.index', compact('categorias'));
    }

    // Método para almacenar una nueva categoría
    public function store(Request $request)
    {
        // Validación de los datos ingresados
        $request->validate([
            'nombre_categoria' => 'required|max:255',
        ]);

        // Creación de la categoría
        Categoria::create([
            'nombre_categoria' => $request->nombre_categoria,
        ]);

        // Redirigir al listado con mensaje de éxito
        //return redirect()->route('categoria.index')->with('success', 'Categoría creada con éxito');
    }
}
