<?php

namespace App\Http\Controllers;

use App\Models\Especificacion;
use App\Models\Tipo;
use Illuminate\Http\Request;

class EspecificacionesController extends Controller
{
    public function especificacionescrear()
    {
        $tipos = Tipo::all();
        $especificaciones = Especificacion::with('tipo')->get()->groupBy('tipo.nombre');
        return view('layouts.admin.especificaciones.ver', compact('tipos', 'especificaciones'));
    }


    public function especificacionesregistrar(Request $request)
    {

        // Validar los datos recibidos
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'tipo_id' => 'required|exists:tipos,id',
        ]);

        // Crear una nueva especificación
        $especificacion = Especificacion::create([
            'descripcion' => $request->descripcion,
            'tipo_id' => $request->tipo_id,
        ]);

        // Retornar una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Especificación registrada exitosamente.',
            'especificacion' => $especificacion,
        ]);
    }

    public function especificacioneseditar(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'id' => 'required|exists:especificaciones,id',
            'descripcion' => 'required|string|max:255',
        ]);

        // Buscar la especificación por ID
        $especificacion = Especificacion::findOrFail($request->id);

        // Actualizar la especificación
        $especificacion->descripcion = $request->descripcion;
        $especificacion->save();

        // Retornar una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Especificación actualizada exitosamente.',
            'especificacion' => $especificacion,
        ]);
    }
    public function especificacioneseliminar(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'id' => 'required|exists:especificaciones,id',
        ]);

        // Buscar la especificación por ID
        $especificacion = Especificacion::findOrFail($request->id);

        // Eliminar la especificación
        $especificacion->delete();

        // Retornar una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Especificación eliminada exitosamente.',
        ]);
    }
}