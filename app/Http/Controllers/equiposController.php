<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class equiposController extends Controller
{
    public function index(){
        $datos = DB::select("select * from equipos");
        return view("equipos")->with("datos", $datos);
    }
}
