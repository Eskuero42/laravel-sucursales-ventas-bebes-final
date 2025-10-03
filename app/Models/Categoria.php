<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;


    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'tipo',
        'categoria_id',
        'sucursal_id',
    ];

    public function sucursales_categorias()
    {
        return $this->hasMany(Sucursal_Categoria::class, 'categoria_id');
    }

    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class, 'sucursales_categorias', 'categoria_id', 'sucursal_id');
    }

    public function categoria_padre()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function categorias_hijos()
    {
        return $this->hasMany(Categoria::class, 'categoria_id');
    }

    // Relación recursiva para obtener todos los hijos (subcategorías anidadas)
    public function categorias_hijosRecursive()
    {
        return $this->categorias_hijos()->with('categorias_hijosRecursive');
    }
}
