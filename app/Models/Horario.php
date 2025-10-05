<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'sucursal_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'cerrado'
    ];

    protected $casts = [
        'cerrado' => 'boolean',
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
}