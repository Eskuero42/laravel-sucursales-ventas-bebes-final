<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    use HasFactory;

    protected $table = 'catalogos';

    protected $fillable = [
        'articulo_id',
        'tipo_id',
        'especificacion_id'
    ];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function especificacion()
    {
        return $this->belongsTo(Especificacion::class);
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}
