<?php

namespace App\Http\Controllers;

use App\Models\Tipo;

use Illuminate\Http\Request;

class TiposController extends Controller
{
    

    public function tiposver()
    {
        $tipos = Tipo::with('especificaciones')->get();

        return view('layouts.admin.tipos.ver', compact('tipos'));
    }

    public function tiposregistrar(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Crear un nuevo tipo
        $tipo = Tipo::create([
            'nombre' => $request->nombre,
        ]);

        // Retornar una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Tipo registrado exitosamente.',
            'tipo' => $tipo,
        ]);
    }
    public function tiposeditar(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'id' => 'required|integer|exists:tipos,id',
            'nombre' => 'required|string|max:255',
        ]);

        // Buscar el tipo por ID
        $tipo = Tipo::findOrFail($request->id);

        // Actualizar el tipo
        $tipo->update([
            'nombre' => $request->nombre,
        ]);

        // Retornar una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Tipo actualizado exitosamente.',
            'tipo' => $tipo,
        ]);
    }


    public function tiposeliminar(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'id' => 'required|integer|exists:tipos,id',
        ]);

        // Buscar el tipo por ID
        $tipo = Tipo::findOrFail($request->id);

        // Eliminar el tipo
        $tipo->delete();

        // Retornar una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Tipo eliminado exitosamente.',
        ]);
    }
}