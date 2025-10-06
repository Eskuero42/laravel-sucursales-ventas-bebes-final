<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function vender()
    {
        return view('layouts.admin.ventas.vender');
    }
}
