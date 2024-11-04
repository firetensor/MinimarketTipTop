<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordenDetalle extends Model
{
    use HasFactory;

    public function orden(){
        return $this->belongsTo(Orden::class, 'id_orden');
    }
    public function producto(){
        return $this->belongsTo(Producto::class,'id_producto');
    }
}
