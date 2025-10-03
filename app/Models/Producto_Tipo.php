<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_Tipo extends Model
{
    use HasFactory;

    protected $table = 'productos_tipos';

    protected $fillable = [
        'producto_id',
        'tipo_id',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }
}
