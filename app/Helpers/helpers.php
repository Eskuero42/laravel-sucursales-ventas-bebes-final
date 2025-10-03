<?php

use App\Models\Categoria;
use App\Models\Sucursal;

function userObtenerSucursales()
{
    return Sucursal::all();
}

function userObtenerCategorias($sucursal_id = null)
{
    try {
        $query = Categoria::whereNull('categoria_id')
            ->with('categorias_hijos.categorias_hijos');

        if ($sucursal_id) {
            $query->whereHas('sucursales', function ($q) use ($sucursal_id) {
                $q->where('sucursales.id', $sucursal_id);
            });
        }

        return $query->get();
    } catch (\Exception $e) {
        return abort(404, "Algo salió mal! " . $e->getMessage());
    }
}

function getSelectedSucursal()
{
    $sucursal_id = request('sucursal_id');
    if ($sucursal_id) {
        return Sucursal::find($sucursal_id);
    }
    return null;
}