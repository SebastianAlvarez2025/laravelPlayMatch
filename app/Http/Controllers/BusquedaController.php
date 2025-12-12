<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusquedaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q'); 
        return "Buscando: " . $query;
    }
}
