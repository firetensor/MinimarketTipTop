<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table='proveedores';
    protected $primaryKey='idproveedor';
    protected $fillable=['nombresproveedor','celularproveedor','tipodocumentoproveedor',
    'correoproveedor','nrodocumentoproveedor','direccionproveedor',
    'fecharegistroproveedor','fechaupdateproveedor','estadoproveedor','id'];
    public $timestamps=false;

    public function users()
    {
        return $this->hasOne(User::class,'id','id');
    }
    public function compras()
{
    return $this->hasMany(Compra::class);
}

}
