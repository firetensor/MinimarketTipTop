<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function index()
    {
        // Recupera todas las categorías
        $productos = Producto::all();
        $productos = Producto::with(['categoria', 'user'])->get();
        // Pasa las categorías a la vista
        return view('productos.index', compact('productos'));
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

 // Guardar la imagen si se proporciona
 if ($request->hasFile('imagen')) {
    $producto->imagen = $request->file('imagen')->store('imagenes'); // Ajusta la ruta según sea necesario
}

// Guardar el producto en la base de datos
$producto->save();

// Redirigir a la lista de productos con un mensaje de éxito
return redirect()->route('producto.index')->with('success', 'Producto guardado con éxito.');
    }






    public function create()
    {
        // Generar un código único para el nuevo producto
        $ultimoProducto = Producto::latest()->first();
        $nuevoCodigo = 'PROD-' . str_pad(($ultimoProducto ? $ultimoProducto->id + 1 : 1), 5, '0', STR_PAD_LEFT);

        // Recupera todas las categorías
        $categorias = Categoria::all();

        // Recupera el usuario autenticado
        $usuario = Auth::user();

        // Pasar el código generado, las categorías y el usuario a la vista
        return view('productos.create', compact('nuevoCodigo', 'categorias', 'usuario'));
    }

}
