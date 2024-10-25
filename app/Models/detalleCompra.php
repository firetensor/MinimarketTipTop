<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleCompra extends Model
{
    use HasFactory;

    public function compra(){
        return $this->belongsTo(Compra::class, 'id_compra');
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function producto(){
        return $this->belongsTo(Producto::class,'id_producto');
    }
}
