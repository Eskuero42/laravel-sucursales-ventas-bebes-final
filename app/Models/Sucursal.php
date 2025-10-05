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
        'direccion',
        'horario_inicio',
        'horario_fin',
        'latitud',
        'longitud'
    ];

    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }

    public function sucursal_categorias()
    {
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
