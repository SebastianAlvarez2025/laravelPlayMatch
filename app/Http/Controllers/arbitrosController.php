<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class arbitrosController extends Controller
{
    public function index(){
        $datos = DB::select("select * from arbitros");
        return view("arbitros")->with("datos", $datos);
    }
}
