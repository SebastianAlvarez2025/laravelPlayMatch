<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class posicionesController extends Controller
{
    public function index(){
        $datos = DB::select("select * from posiciones");
        return view("posiciones")->with("datos",$datos);
    }
}
