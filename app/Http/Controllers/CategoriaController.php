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
    return redirect()->route('categoria.index')->with('success', 'Categoría creada con éxito');
}


    public function update(Request $request, $id)
{
    // Validar los datos
    $request->validate([
        'nombre_categoria' => 'required|string|max:255',
    ]);

    // Buscar la categoría por ID
    $categoria = Categoria::findOrFail($id);

    // Actualizar el nombre de la categoría
    $categoria->nombre_categoria = $request->nombre_categoria;

    // Guardar los cambios en la base de datos
    $categoria->save();

    // Retornar una respuesta a la solicitud AJAX
    return response()->json([
        'message' => 'Categoría actualizada exitosamente',
        'categoria' => $categoria
    ]);
}

public function destroy($id)
{
    // Buscar la categoría por ID
    $categoria = Categoria::findOrFail($id);

    // Eliminar la categoría
    $categoria->delete();

    // Retornar una respuesta a la solicitud AJAX
    return response()->json([
        'message' => 'Categoría eliminada exitosamente'
    ]);
}


}
