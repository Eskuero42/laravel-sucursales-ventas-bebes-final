<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $table = 'tipos';

    protected $fillable = [
        'nombre',
    ];

    public function producto_tipos()
    {
        return $this->hasMany(Producto_Tipo::class);
    }

    public function especificaciones()
    {
        return $this->hasMany(Especificacion::class);
    }

    public function catalogos()
    {
        return $this->hasMany(Catalogo::class);
    }
}
