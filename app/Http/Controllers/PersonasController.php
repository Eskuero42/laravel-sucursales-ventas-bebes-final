<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Persona;

use Illuminate\Http\Request;

class PersonasController extends Controller
{
    public function personaslistar()
    {
        $ciudades = Ciudad::all();
        $personas = Persona::all();
        return view('layouts.admin.personas.listar', compact('ciudades', 'personas'));
    }

    public function personasregistrar(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'carnet' => 'required|string|max:20',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'correo' => 'required|email|max:100',
            'celular' => 'required|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'ciudad_id' => 'required|exists:ciudades,id',
        ]);

        // Crear una nueva persona
        $persona = Persona::create($request->all());

        // Retornar una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Persona registrada exitosamente.',
            'persona' => $persona,
        ]);
    }

    public function personaseditar(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'id' => 'required|exists:personas,id',
            'carnet' => 'required|string|max:20',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'correo' => 'required|email|max:100',
            'celular' => 'required|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'ciudad_id' => 'required|exists:ciudades,id',
        ]);

        // Buscar la persona por ID
        $persona = Persona::findOrFail($request->id);

        // Actualizar la persona
        $persona->update($request->all());

        // Retornar una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Persona actualizada exitosamente.',
            'persona' => $persona,
        ]);
    }

    public function personasver()
    {
        return view('layouts.admin.personas.ver',);
    }
}
