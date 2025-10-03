<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;

    protected $table = 'caracteristicas';

    protected $fillable = [
        'icono',
        'descripcion',
        'producto_id',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
