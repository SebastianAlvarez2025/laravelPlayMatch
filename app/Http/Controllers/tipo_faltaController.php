<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tipo_faltaController extends Controller
{
    public function index(){
        $datos = DB::select("select * from tipo_falta");
        return view("tipo_falta")->with("datos", $datos);
    }
}
