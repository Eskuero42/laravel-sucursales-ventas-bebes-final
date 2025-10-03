<?php

namespace App\Http\Controllers;

use App\Models\Caracteristica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CaracteristicasController extends Controller
{
    public function registrarcaracteristicas(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'descripcion' => 'required|string|max:1000',
            'icono' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $ruta = $request->file('icono')->store('caracteristicas', 'public');

        Caracteristica::create([
            'producto_id' => $request->producto_id,
            'descripcion' => $request->descripcion,
            'icono' => $ruta,
        ]);

        return response()->json(['success' => true, 'message' => 'Característica registrada.']);
    }

    public function editarcaracteristicas(Request $request)
    {
        foreach ($request->caracteristicas as $item) {
            $caracteristica = Caracteristica::find($item['id']);
            if (!$caracteristica) continue;

            $caracteristica->descripcion = $item['descripcion'];

            if (isset($item['icono']) && $item['icono'] instanceof \Illuminate\Http\UploadedFile) {
                $ruta = $item['icono']->store('caracteristicas', 'public');
                $caracteristica->icono = $ruta;
            }

            $caracteristica->save();
        }

        return response()->json(['success' => true, 'message' => 'Características actualizadas.']);
    }

    /** UNA CARACTERISTICA */

    public function editarCaracteristica(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:caracteristicas,id',
                'descripcion' => 'required|string',
                'icono' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $caracteristica = Caracteristica::find($request->id);

            $caracteristica->descripcion = $request->descripcion;

            if ($request->hasFile('icono')) {
                // eliminar el icono anterior si existe
                if ($caracteristica->icono && Storage::disk('public')->exists($caracteristica->icono)) {
                    Storage::disk('public')->delete($caracteristica->icono);
                }
                // guardar el nuevo icono
                $path = $request->file('icono')->store('iconos', 'public');
                $caracteristica->icono = $path;
            }

            $caracteristica->save();

            return response()->json([
                'success' => true,
                'message' => 'Característica actualizada correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function eliminarCaracteristica(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:caracteristicas,id',
            ]);

            $caracteristica = Caracteristica::find($request->id);
            $caracteristica->delete();

            return response()->json([
                'success' => true,
                'message' => 'Característica eliminada correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }
}
