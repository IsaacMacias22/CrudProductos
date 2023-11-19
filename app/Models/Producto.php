<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public function categoria()
    {
        return $this->belongsTo(categoria::class);
    }
    //Indicamos los valores que vamos a enviar en el ORM.
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria_id'
    ];
}
