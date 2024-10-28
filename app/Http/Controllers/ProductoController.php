<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductoController extends Controller
{
    public function index()
    {
        // Recupera todas las categorías
        $productos = Producto::all();
        $productos = Producto::with(['categoria', 'user'])->where('estadoproducto','=',1)->get();
        // Pasa las categorías a la vista
        return view('productos.index', compact('productos'));
    }

    public function buscarProducto(Request $request)
    {
        // Buscar el producto por código
        $producto = Producto::where('codigo', $request->codigo)->first();

        if ($producto) {
            // Obtener la lista de productos que ya están en la sesión de compra
            $compras = session()->get('compras', []);

            // Verificar si el producto ya está en la lista de compras
            $index = array_search($producto->codigo, array_column($compras, 'codigo'));

            if ($index !== false) {
                // Si el producto ya existe, sumar la cantidad
                $compras[$index]['cantidad'] += $request->cantidad;
            } else {
                // Si no existe, agregar el nuevo producto con su cantidad
                $compras[] = [
                    'codigo' => $producto->codigo,
                    'nombre' => $producto->nombre_producto,
                    'cantidad' => $request->cantidad,
                    'costo' => $producto->precio_compra,
                    'total' => $producto->precio_compra * $request->cantidad,
                ];
            }

            // Actualizar la sesión con la nueva lista de productos
            session()->put('compras', $compras);

            return response()->json(['success' => true, 'compras' => $compras]);
        } else {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
        }
    }






    public function store(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre_producto' => 'required|string|max:255',
            'descripcion_producto' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_maximo' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'fecha_ingreso' => 'required|date',
            'id_categoria' => 'required|exists:categorias,id',
            'id_usuario' => 'required|exists:users,id',
            'imagen' => 'nullable|image|max:2048'
        ]);

        // Crear un nuevo producto
        $producto = new Producto();
        $producto->codigo = $request->codigo;
        $producto->nombre_producto = $request->nombre_producto;
        $producto->descripcion_producto = $request->descripcion_producto;
        $producto->stock = $request->stock;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->id_categoria = $request->id_categoria;
        $producto->id_usuario = $request->id_usuario;
        $producto->estadoproducto = 1;


 // Guardar la imagen si se proporciona
 if ($request->hasFile('imagen')) {
    $fileName = $request->file('imagen')->getClientOriginalName();
    $request->file('imagen')->move(public_path('images/productos'), $fileName);
    // Guardar la ruta relativa en la base de datos
    $producto->imagen = 'images/productos/' . $fileName;
}


// Guardar el producto en la base de datos
$producto->save();

// Redirigir a la lista de productos con un mensaje de éxito
return redirect()->route('producto.index')->with('success', 'Producto guardado con éxito.');
    }

    public function create()
    {
        // Generar un código único para el nuevo producto


        // Recupera todas las categorías
        $categorias = Categoria::all();

        // Recupera el usuario autenticado
        $usuario = Auth::user();

        // Pasar el código generado, las categorías y el usuario a la vista
        return view('productos.create', compact('categorias', 'usuario'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all(); // Asegúrate de tener el modelo Categoria
        $usuario = auth()->user();
        return view('productos.update', compact('producto', 'categorias', 'usuario'));



    }


    public function update(Request $request, Producto $producto)
    {
        // Validar la entrada
        $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre_producto' => 'required|string|max:255',
            'descripcion_producto' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'id_categoria' => 'required|exists:categorias,id',
            'id_usuario' => 'required|exists:users,id',
            'imagen' => 'nullable|image|max:2048' // Validación de la imagen
        ]);

        // Actualizar el producto
        $producto->codigo = $request->codigo;
        $producto->nombre_producto = $request->nombre_producto;
        $producto->descripcion_producto = $request->descripcion_producto;
        $producto->stock = $request->stock;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->id_categoria = $request->id_categoria;
        $producto->id_usuario = $request->id_usuario;

        // Guardar la nueva imagen si se proporciona
        if ($request->hasFile('imagen')) {
            // Opcional: eliminar la imagen anterior si es necesario
            if ($producto->imagen) {
                // Eliminar el archivo anterior
                File::delete(public_path($producto->imagen));
            }

            $fileName = $request->file('imagen')->getClientOriginalName();
            $request->file('imagen')->move(public_path('images/productos'), $fileName);
            // Guardar la nueva ruta en la base de datos
            $producto->imagen = 'images/productos/' . $fileName;
        }

        // Guardar los cambios en la base de datos
        $producto->save();

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente');
    }

    public function show($id)
{
    $producto = Producto::findOrFail($id);
    $categorias = Categoria::all(); // Si estás manejando categorías
    $usuario = auth()->user(); // Si el usuario autenticado es relevante
    return view('productos.show', compact('producto', 'categorias', 'usuario'));
}


public function destroy($id)
{
    $producto = Producto::findOrFail($id);
    //$producto->delete();
    $producto->estadoproducto = 0;
        $producto->save();

    return redirect()->route('producto.index')->with('success', 'Cliente eliminado con éxito.');
}



}
