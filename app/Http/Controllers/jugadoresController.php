<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class jugadoresController extends Controller
{
    public function index(){
        $datos = DB::select("select * from jugadores");
        return view("jugadores")->with("datos", $datos);
    }
}
