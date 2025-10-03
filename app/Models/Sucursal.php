<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    protected $table = 'sucursales';
    protected $fillable = [
        'nombre',
        'direccion'
    ];

    public function sucursal_categorias()
    {
        // Una sucursal tiene muchas sucursal_categorias
        return $this->hasMany(Sucursal_Categoria::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(
            Categoria::class,
            'sucursales_categorias',
            'sucursal_id',
            'categoria_id'
        );
    }
}
