<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PedidosController extends Controller
{
    public function ver()
    {
        Carbon::setLocale('es');

        $fecha = Carbon::now()->translatedFormat('l j \\d\\e F Y'); 


        return view('layouts.admin.pedidos.listar', compact('fecha'));
    }

    public function pedidoVer()
    {
        

        return view('layouts.admin.pedidos.ver');   
    }
}
