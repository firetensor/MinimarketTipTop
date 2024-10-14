<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'codigo',
        'id_categoria',
        'imagen',
        'nombre_producto',
        'descripcion_producto',
        'stock',
        'stock_minimo',
        'stock_maximo',
        'precio_compra',
        'precio_venta',
        'fecha_ingreso',
        'id_usuario', // Si es relevante
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function compras()
{
    return $this->hasMany(Compra::class, 'id_producto');
}

}
