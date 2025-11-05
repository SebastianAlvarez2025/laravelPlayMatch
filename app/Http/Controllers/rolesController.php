<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\rolesModelo;

class rolesController extends Controller
{
    //buscar y paginar
    public function index(Request $request){
        $search = $request->input('search');
        $query = DB::table('roles');

        if($search){
            $query->where(function ($q) use($search){
                $q->where ('id_rol','LIKE',"%{$search}%")
                ->orwhere('nombrerol','LIKE',"%{$search}%")
                ->orwhere('descripcion','LIKE',"%{$search}%");
            });
        }
        $datos = $query->paginate(10);
        return view("roles")->with("datos",$datos);
    }
    
// insertar Datos
public function store (Request  $request){
    $request->validate( [
        'id_rol'=>'required|unique:roles,id_rol',
        'nombrerol'=>'required',
        'descripcion'=>'required',

    ]);
    rolesmodelo::crate ($request->all());
    return redirect()->route('roles.index')->with('succes','rol registrado en la plataforma');

}
}
