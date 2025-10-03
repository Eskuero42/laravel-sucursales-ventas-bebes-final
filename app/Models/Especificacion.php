<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especificacion extends Model
{
    use HasFactory;
    protected $table = 'especificaciones';
    protected $fillable = [
        'descripcion',
        'tipo_id',
    ];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function catalogos()
    {
        return $this->hasMany(Catalogo::class);
    }
}
