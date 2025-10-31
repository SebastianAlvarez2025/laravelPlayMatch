<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class fechaController extends Controller
{
    public function index(){
        $datos = DB::select("select * from fechas");
        return view("fechas")->with("datos", $datos);
    }
}
