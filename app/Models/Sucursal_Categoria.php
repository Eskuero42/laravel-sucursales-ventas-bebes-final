<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal_Categoria extends Model
{
    use HasFactory;
    
    protected $table = 'sucursales_categorias';

    protected $fillable = [
        'sucursal_id',
        'categoria_id'
    ];

     public function sucursal()
    {
        // Una sucursal_categoria pertenece a una sola sucursal
        return $this->belongsTo(Sucursal::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

     public function sucursal_articulos()
    {
        return $this->hasMany(Sucursal_Articulo::class);
    }
}

