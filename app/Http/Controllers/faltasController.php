<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class faltasController extends Controller
{
    public function index(){
        $datos = DB::select("select * from faltas");
        return view("faltas")->with("datos", $datos);
    }
}
