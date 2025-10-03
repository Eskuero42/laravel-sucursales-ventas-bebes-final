<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Articulo;
use App\Models\Sucursal_Articulo;
use App\Models\Posicion;
use App\Models\Catalogo;
use App\Models\Producto;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ArticulosController extends Controller
{
    public function articulosRegistrar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'producto_id' => 'required|exists:productos,id',
            'sucursales_categorias_id' => 'required|exists:sucursales_categorias,id',
            'stock' => 'required|integer|min:0',
            'descuento' => 'nullable|numeric|min:0',
            'descuento_porcentaje' => 'nullable|numeric|min:0|max:100',
            'fecha_vencimiento' => 'nullable|date',
            'precio_radio' => 'required|in:nuevo,actual',
            'precio_nuevo' => 'nullable|numeric|min:0',
            'precio_actual' => 'required|numeric|min:0',
            'especificaciones' => 'nullable|array',
            'imagen' => 'nullable|array', // Permitir sin imágenes
            'imagen.*' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        DB::beginTransaction();

        try {
            // Obtener el producto
            $producto = Producto::findOrFail($request->producto_id);

            // Generar código secuencial más robusto
            $maxSequence = Articulo::where('codigo', 'like', $producto->codigo . '-%')
                ->selectRaw('CAST(SUBSTRING_INDEX(codigo, "-", -1) AS UNSIGNED) as sequence_num')
                ->orderByDesc('sequence_num')
                ->first();

            $nuevoCodigo = ($maxSequence ? $maxSequence->sequence_num : 0) + 1;
            $codigoCompleto = $producto->codigo . '-' . str_pad($nuevoCodigo, 4, '0', STR_PAD_LEFT);

            // Determinar precio según selección
            $precio = $request->precio_radio === 'nuevo'
                ? $request->precio_nuevo
                : $request->precio_actual;

            // Crear el artículo
            $articulo = Articulo::create([
                'codigo' => $codigoCompleto,
                'nombre' => $request->nombre,
                'precio' => $precio,
                'stock' => $request->stock,
            ]);

            // Crear relación Sucursal_Articulo (funcionalidad del primer método)
            Sucursal_Articulo::create([
                'precio' => $precio,
                'stock' => $request->stock,
                'descuento' => $request->descuento ?? 0,
                'descuento_porcentaje' => $request->descuento_porcentaje ?? 0,
                'descuento_habilitado' => ($request->descuento > 0 || $request->descuento_porcentaje > 0),
                'estado' => 'vigente',
                'fecha_vencimiento' => $request->fecha_vencimiento,
                'sucursales_categorias_id' => $request->sucursales_categorias_id,
                'producto_id' => $request->producto_id,
                'articulo_id' => $articulo->id,
            ]);

            // Guardar especificaciones
            if ($request->has('especificaciones')) {
                foreach ($request->especificaciones as $tipo_id => $especificacion_ids) { // $especificacion_ids is now an array
                    if (is_array($especificacion_ids)) { // Ensure it's an array
                        foreach ($especificacion_ids as $especificacion_id) { // Iterate over each selected ID
                            if (!empty($especificacion_id)) {
                                Catalogo::create([
                                    'articulo_id' => $articulo->id,
                                    'tipo_id' => $tipo_id,
                                    'especificacion_id' => $especificacion_id,
                                ]);
                            }
                        }
                    } elseif (!empty($especificacion_ids)) { // Handle single selection case if it somehow occurs
                        Catalogo::create([
                            'articulo_id' => $articulo->id,
                            'tipo_id' => $tipo_id,
                            'especificacion_id' => $especificacion_ids,
                        ]);
                    }
                }
            }

            // Guardar imágenes
            if ($request->hasFile('imagen')) {
                foreach ($request->file('imagen') as $file) {
                    if ($file && $file->isValid()) {
                        $fileName = uniqid('articulo_') . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                        $destinationPath = public_path('archivos/articulos');
                        $file->move($destinationPath, $fileName);

                        Posicion::create([
                            'imagen' => 'archivos/articulos/' . $fileName,
                            'articulo_id' => $articulo->id,
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Artículo registrado correctamente.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al registrar artículo: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error en el servidor: ' . $e->getMessage()
            ], 500);
        }
    }

    public function articuloSucursalRegistrar(Request $request)
    {
        //\Log::info($request->all());
        //exit;
        // Determinar precio según selección
        $precio = $request->precio_radio === 'nuevo'
            ? $request->precio_nuevo
            : $request->precio_actual;

        $codigo = IdGenerator::generate(['table' => 'articulos', 'field' => 'codigo', 'length' => 9, 'prefix' => 'R-']);

        $articulo_id = Articulo::insertGetId([
            'codigo' => $codigo,
            'nombre' => $request->nombre,
            'precio' => $precio,
            'stock' => $request->stock
        ]);


        Sucursal_Articulo::create([
            'precio' => $precio,
            'descuento' => $request->input('descuento', 0),
            'descuento_porcentaje' => $request->descuento_porcentaje ?? 0,
            'descuento_habilitado' => ($request->descuento > 0 || $request->descuento_porcentaje > 0),
            'sucursales_categorias_id' => $request->sucursales_categorias_id,
            'producto_id' => $request->producto_id,
            'articulo_id' => $articulo_id,
            'codigo' => $codigo

        ]);

        // Guardar imágenes
        if ($request->hasFile('imagen')) {
            foreach ($request->file('imagen') as $img) {
                $image = $img;
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = 'archivos/articulos/' . $imageName; // Ruta relativa a public/

                // Redimensionar y optimizar la imagen
                $img = Image::make($image->getRealPath());
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                // Guardar la imagen
                $img->save(public_path($imagePath));

                Posicion::create([
                    'imagen' => $imagePath,
                    'articulo_id' => $articulo_id,
                ]);
            }
        }

        // Guardar especificaciones
        if ($request->has('especificaciones')) {
            foreach ($request->especificaciones as $tipo_id => $especificaciones) {
                // Aseguramos que $especificaciones sea un array (por si acaso)
                if (!is_array($especificaciones)) {
                    $especificaciones = [$especificaciones];
                }

                foreach ($especificaciones as $especificacion_id) {
                    // Opcional: validar que sean valores válidos
                    if (empty($especificacion_id)) {
                        continue;
                    }

                    Catalogo::create([
                        'articulo_id' => $articulo_id,
                        'tipo_id' => $tipo_id,
                        'especificacion_id' => $especificacion_id,
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Articulo registrado exitosamente.'
        ]);
    }

    public function articuloDuplicarSucursalRegistrar(Request $request)
    {
        //\Log::info($request->all());
        //exit;
        $articulo_id = Articulo::insertGetId([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request->stock
        ]);


        Sucursal_Articulo::create([
            'precio' => $request->precio,
            'descuento' => $request->input('descuento', 0),
            'descuento_porcentaje' => $request->descuento_porcentaje ?? 0,
            'descuento_habilitado' => ($request->descuento > 0 || $request->descuento_porcentaje > 0),
            'sucursales_categorias_id' => $request->sucursales_categorias_id,
            'producto_id' => $request->producto_id,
            'articulo_id' => $articulo_id,

        ]);

        // Guardar imágenes
        if ($request->hasFile('imagen')) {
            foreach ($request->file('imagen') as $img) {
                $image = $img;
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = 'archivos/articulos/' . $imageName; // Ruta relativa a public/

                // Redimensionar y optimizar la imagen
                $img = Image::make($image->getRealPath());
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                // Guardar la imagen
                $img->save(public_path($imagePath));

                Posicion::create([
                    'imagen' => $imagePath,
                    'articulo_id' => $articulo_id,
                ]);
            }
        }

        // Guardar especificaciones
        if ($request->has('especificaciones')) {
            foreach ($request->especificaciones as $tipo_id => $especificaciones) {
                // Aseguramos que $especificaciones sea un array (por si acaso)
                if (!is_array($especificaciones)) {
                    $especificaciones = [$especificaciones];
                }

                foreach ($especificaciones as $especificacion_id) {
                    // Opcional: validar que sean valores válidos
                    if (empty($especificacion_id)) {
                        continue;
                    }

                    Catalogo::create([
                        'articulo_id' => $articulo_id,
                        'tipo_id' => $tipo_id,
                        'especificacion_id' => $especificacion_id,
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Artículo duplicado exitosamente.'
        ]);
    }
}
