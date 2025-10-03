<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\Categoria;
use App\Models\Producto_Tipo;
use App\Models\Tipo;
use App\Models\Sucursal_Articulo;
use App\Models\Sucursal_Categoria;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class ProductosController extends Controller
{
    public function u_productosver($id)
    {
        $producto = Producto::with(['tipos.especificaciones'])->findOrFail($id);
        $sucursales_articulos = Sucursal_Articulo::where('producto_id', $id)
            ->with(['articulo.posiciones', 'articulo.catalogos.especificacion.tipo'])
            ->get();
        $initial_sa = $sucursales_articulos->first(function ($sa) {
            return $sa->articulo && $sa->articulo->posiciones->isNotEmpty();
        }) ?? $sucursales_articulos->first();

        return view('layouts.users.productos.ver', compact('producto', 'sucursales_articulos', 'initial_sa'));
    }

    public function productosListar(Request $request)
    {
        $sucursales = Sucursal::all();
        $sucursal_id_activa = $request->input('sucursal_id', $sucursales->first()->id ?? null);

        $productos_query = Sucursal_Articulo::with([
            'producto',
            'articulo',
            'sucursales_categorias.sucursal',
            'sucursales_categorias.categoria'
        ]);

        if ($sucursal_id_activa) {
            $productos_query->whereHas('sucursales_categorias', function ($query) use ($sucursal_id_activa) {
                $query->where('sucursal_id', $sucursal_id_activa);
            });
        }

        $productos = $productos_query->paginate(10);
        $tipos = Tipo::all();
        $categorias = Categoria::whereNull('categoria_id')->with('categorias_hijosRecursive')->get();


        return view('layouts.admin.productos.listar', compact('productos', 'sucursales', 'sucursal_id_activa', 'tipos', 'categorias'));
    }

    public function getCaracteristicas($id)
    {
        $producto = Producto::with('caracteristicas')->findOrFail($id);
        return response()->json($producto->caracteristicas);
    }

    public function getDetalles($id)
    {
        $producto = Producto::with('detalles')->findOrFail($id);
        return response()->json($producto->detalles);
    }

    public function getTiposEspecificaciones($id)
    {
        $producto = Producto::with('tipos.especificaciones')->findOrFail($id);
        return response()->json($producto->tipos);
    }

    public function listarArticulosPorProducto($id, $sucursales_categorias_id)
    {
        $producto = Producto::with(['detalles', 'caracteristicas', 'producto_tipos.tipo.especificaciones'])->findOrFail($id);
        $sucursal_categoria = Sucursal_Categoria::with(['sucursal', 'categoria'])->findOrFail($sucursales_categorias_id);
        $articulos = Sucursal_Articulo::where('producto_id', $id)
            ->where('sucursales_categorias_id', $sucursales_categorias_id)
            ->whereNotNull('articulo_id')
            ->with(['articulo.posiciones', 'articulo.catalogos.tipo', 'articulo.catalogos.especificacion'])
            ->get();

        return view('layouts.admin.articulos.listar', compact('articulos', 'producto', 'sucursal_categoria'));
    }

    public function productoSucursalRegistrar(Request $request)
    {
        //\Log::info($request->all());
        //exit;
        // Procesar la imagen con Intervention Image
        $image = $request->file('imagen');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = 'archivos/productos/' . $imageName; // Ruta relativa a public/

        // Redimensionar y optimizar la imagen
        $img = Image::make($image->getRealPath());
        $img->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        // Guardar la imagen
        $img->save(public_path($imagePath));

        $producto_id = Producto::insertGetId([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen_principal' => $imagePath,
            'precio' => $request->precio
        ]);

        $tipos = $request->tipos;
        foreach ($tipos as $tipo) {
            Producto_Tipo::create([
                'producto_id' => $producto_id,
                'tipo_id' => $tipo
            ]);
        }

        Sucursal_Articulo::create([
            'sucursales_categorias_id' => $request->sucursal_categoria_id,
            'producto_id' => $producto_id
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Producto registrado exitosamente.'
        ]);
    }
}
