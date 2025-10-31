<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class encuentrosController extends Controller
{
    public function index(){
        $datos = DB::select("select * from encuentros");
        return view("encuentros")->with("datos", $datos);
    }
}
