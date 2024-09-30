<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function user() // Nueva relación con el modelo User
    {
        return $this->belongsTo(User::class, 'id_usuario'); // Asegúrate de que el nombre de la columna sea correcto
    }
}
