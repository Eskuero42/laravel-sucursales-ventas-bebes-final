<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'imagen_principal',
        'precio',
    ];

    public function sucursales_articulos()
    {
        return $this->hasMany(Sucursal_Articulo::class);
    }

    public function detalles()
    {
        return $this->hasMany(Detalle::class);
    }

    public function caracteristicas()
    {
        return $this->hasMany(Caracteristica::class);
    }

    public function producto_tipos()
    {
        return $this->hasMany(Producto_Tipo::class);
    }

    public function tipos()
    {
        return $this->belongsToMany(Tipo::class, 'productos_tipos');
    }
}
