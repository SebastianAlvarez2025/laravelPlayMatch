<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    public function index(){
        $datos = DB::select("select * from usuarios");
        return view("usuarios")->with("datos", $datos);
    }
}
