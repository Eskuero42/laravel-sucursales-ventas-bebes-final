<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Slider;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function principal()
    {
        try {
            $sucursalesConCategorias = Sucursal::whereHas('sucursal_categorias.categoria', function ($query) {
                $query->whereNull('categoria_id');
            })->with(['sucursal_categorias' => function ($query) {
                $query->whereHas('categoria', function ($q) {
                    $q->whereNull('categoria_id');
                })->with('categoria');
            }])->get();

            $sliders = Slider::where('estado', 'activo')->get();
            $iconos = Slider::where('tipo', 'icono')->get();

            //Obtener **solo 4** productos aleatorios
            $productos = Producto::inRandomOrder()
                ->take(4)
                ->get();

            return view('layouts.users.principal', compact('sucursalesConCategorias', 'sliders', 'iconos', 'productos'));
        } catch (\Exception $e) {
            return abort(404, "Algo salió mal! " . $e->getMessage());
        }
    }

    public function login()
    {
        try {

            return view('layouts.users.login.login');
        } catch (\Exception $e) {
            return abort(404, "Algo salio mal!");
        }
    }

    public function index()
    {
        try {

            return view('layouts.admin.dashboard');
        } catch (\Exception $e) {
            return abort(404, "Algo salio mal!");
        }
    }

    public function productos()
    {
        try {

            return view('layouts.users.productos');
        } catch (\Exception $e) {
            return abort(404, "Algo salio mal!");
        }
    }
}
