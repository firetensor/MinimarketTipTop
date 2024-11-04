<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    public function detalles(){
        return $this->hasMany(ordenDetalle::class, 'id_orden');
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class,'id_proveedor','idproveedor');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
