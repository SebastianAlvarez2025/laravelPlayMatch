<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class resultadosController extends Controller
{
    public function index(){
        $datos = DB::select("select * from resultados");
        return view("resultados")->with("datos", $datos);
    }
}
