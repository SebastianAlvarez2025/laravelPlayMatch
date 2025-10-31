<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class rolesController extends Controller
{
    public function index(){
        $datos = DB::select("select * from roles");
        return view("roles")->with("datos", $datos);
    }
}
