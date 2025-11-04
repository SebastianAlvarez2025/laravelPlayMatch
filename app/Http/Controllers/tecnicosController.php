<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tecnicosController extends Controller
{
    public function index(){
        $datos = DB::select("select * from tecnicos");
        return view("tecnicos")->with("datos", $datos);
    }
}

