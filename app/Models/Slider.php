<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';

    protected $fillable = [
        'sucursal_id',
        'imagen',
        'titulo',
        'descripcion',
        'tipo',
        'posicion',
        'estado',
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }
}
