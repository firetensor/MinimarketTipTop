<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempoOrden extends Model
{
    use HasFactory;

    public function producto(){
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
