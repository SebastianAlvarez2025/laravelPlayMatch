<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class premiacionController extends Controller
{
    public function index(){
        $datos = DB::select("select * from premiacion");
        return view("premiacion")->with("datos", $datos);
    }
}
