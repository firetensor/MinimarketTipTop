<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table='ventas';
    protected $primaryKey='id';
    protected $fillable=['id_cliente','total_pagar','idusuario','created_at','estadoventa'];
    public $timestamps=false;

    public function users()
    {
        return $this->hasOne(User::class,'id','idusuario');
    }

    public function clientes()
    {
        return $this->hasOne(Cliente::class,'id','idcliente');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idcliente');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idusuario');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }

    public function boleta()
{
    return $this->hasOne(Boleta::class, 'venta_id'); // Asegúrate de usar el nombre correcto del modelo Boleta y la clave foránea
}
}

