<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoriasController extends Controller
{
    public function index(){
        $datos = DB::select("select * from categorias");
        return view("categorias")->with("datos", $datos);
    }
}