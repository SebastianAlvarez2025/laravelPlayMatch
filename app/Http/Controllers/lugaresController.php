<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class lugaresController extends Controller
{
    public function index(){
        $datos = DB::select("select * from lugares");
        return view("lugares")->with("datos", $datos);
    }
}
