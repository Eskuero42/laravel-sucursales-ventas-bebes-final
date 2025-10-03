<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal_Articulo extends Model
{
    use HasFactory;

    protected $table = "sucursales_articulos";

    protected $fillable = [
        'codigo',
        'precio',
        'stock',
        'descuento',
        'descuento_habilitado',
        'descuento_porcentaje',
        'estado',
        'sucursales_categorias_id',
        'producto_id',
        'articulo_id',
        'fecha_vencimiento',
    ];

    public function sucursales_categorias()
    {
        return $this->belongsTo(Sucursal_Categoria::class, 'sucursales_categorias_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }

    public function getPrecioDescuentoAttribute()
    {
        if ($this->descuento_habilitado) {
            if ($this->descuento_porcentaje > 0) {
                return $this->precio * (1 - $this->descuento_porcentaje / 100);
            } else {
                return $this->precio - $this->descuento;
            }
        }
        return $this->precio;
    }
}
