<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\Sucursal;

class SlidersController extends Controller
{
    public function u_slidersListar()
    {
        try {
            $sliders = Slider::whereIn('tipo', ['principal', 'secundario'])
                ->orderBy('created_at', 'desc')
                ->get();
            $iconos = Slider::where('tipo', 'icono')->get();
            return view('layouts.admin.sliders.listar', compact('sliders', 'iconos'));
        } catch (\Exception $e) {
            return abort(404, "Algo salió mal!");
        }
    }

    public function u_slidersSucursales()
    {
        try {
            $sucursales = Sucursal::orderBy('nombre')->get();

            return view('layouts.admin.sliders.listar', compact('sucursales'));
        } catch (\Exception $e) {
            return abort(404, "Error al cargar sucursales");
        }
    }

    public function porSucursal($id)
    {
        try {
            $sucursal = Sucursal::findOrFail($id);

            // Filtrar sliders por tipo
            $sliders = $sucursal->sliders()
                ->whereIn('tipo', ['principal', 'secundario'])
                ->get();

            $iconos = $sucursal->sliders()
                ->where('tipo', 'icono')
                ->get();

            return view('layouts.admin.sliders.listar_s', compact('sucursal', 'sliders', 'iconos'));
        } catch (\Exception $e) {
            return abort(404, "Error al cargar sliders de la sucursal");
        }
    }

    public function u_slidersPorSucursal($id)
    {
        try {
            $sucursal = Sucursal::with('sliders')->findOrFail($id);

            return view('layouts.admin.sliders.listar', compact('sucursal'));
        } catch (\Exception $e) {
            return abort(404, "Error al cargar sliders de la sucursal");
        }
    }

    public function u_slidersRegistrarCategoria(Request $request)
    {
        try {
            $request->validate([
                'sucursal_id' => 'required|exists:sucursales,id',
                'titulo' => 'nullable|string|max:255',
                'descripcion' => 'required|string|max:255',
                'tipo' => 'required|in:principal,secundario,icono',
                'posicion' => 'required|in:izquierda,centro,derecha',
                'estado' => 'required|in:activo,inactivo',
                'imagen' => 'required|image|max:2048',
            ]);

            $fileName = null;
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('archivos/sliders');
                $file->move($destinationPath, $fileName);

                $fileName = 'archivos/sliders/' . $fileName;
            }

            Slider::create([
                'sucursal_id' => $request->sucursal_id,  // <-- agregado
                'imagen' => $fileName,
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'tipo' => $request->tipo,
                'posicion' => $request->posicion,
                'estado' => $request->estado,
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Slider registrado correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function u_slidersActualizarCategoria(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:sliders,id',
                'sucursal_id' => 'required|exists:sucursales,id',
                'titulo' => 'nullable|string|max:255',
                'descripcion' => 'nullable|string|max:255',
                'tipo' => 'nullable|in:principal,secundario,icono', // ⬅️ Agregué 'icono'
                'posicion' => 'nullable|in:izquierda,centro,derecha',
                'estado' => 'nullable|in:activo,inactivo',
                'imagen' => 'nullable|image|max:2048',
            ]);

            $slider = Slider::findOrFail($request->id);

            // ⬅️ IMPORTANTE: Agregué 'sucursal_id' aquí
            $data = $request->only(['sucursal_id', 'titulo', 'descripcion', 'tipo', 'posicion', 'estado']);

            // Si se subió una nueva imagen
            if ($request->hasFile('imagen')) {
                // Eliminar imagen anterior si existe
                if ($slider->imagen && file_exists(public_path($slider->imagen))) {
                    unlink(public_path($slider->imagen));
                }

                // Subir nueva imagen
                $file = $request->file('imagen');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('archivos/sliders'), $fileName);
                $data['imagen'] = 'archivos/sliders/' . $fileName;
            }

            $slider->update($data);

            return response()->json([
                'success' => true,
                'msg' => 'Slider actualizado correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Error: ' . $e->getMessage()
            ]);
        }
    }
}
