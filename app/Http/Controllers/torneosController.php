<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class torneosController extends Controller
{
    public function index(){
        $datos = DB::select("select * from torneos");
        return view("torneos")->with("datos", $datos);
    }
}








