<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'articulos';

    protected $fillable = [
        'codigo',
        'nombre',
        'precio',
        'stock',
    ];

    public function sucursal_articulos()
    {
        return $this->hasMany(Sucursal_Articulo::class);
    }

    public function catalogos()
    {
        return $this->hasMany(Catalogo::class);
    }

    public function posiciones()
    {
        return $this->hasMany(Posicion::class);
    }
}
