<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class jugadoresController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $query = DB::table('jugadores');

        if($search){
            $query->where(function ($q) use($search){
                $q->where('id_jugador','LIKE',"%{$search}%")
                  ->orWhere('id_usuario','LIKE',"%{$search}%")
                  ->orWhere('id_equipo','LIKE',"%{$search}%")
                  ->orWhere('numero_camiseta','LIKE',"%{$search}%")
                  ->orWhere('posicion','LIKE',"%{$search}%")
                  ->orWhere('estado','LIKE',"%{$search}%");
            });
        }

        $datos = $query->paginate(10);


        $equipos = DB::table('equipos')->get();
        $usuarios = DB::table('usuarios')->get();

        return view("jugadores", compact('datos', 'equipos', 'usuarios'));
    }
    
    public function create(){
    $equipos = DB::table('equipos')->get(); 
    $usuarios = DB::table('usuarios')->get();

    return view('jugadores.create', compact('equipos', 'usuarios'));
    }

    public function store(Request $request){
    DB::table('jugadores')->insert([
        'id_jugador' => $request->id_jugador,
        'id_usuario' => $request->id_usuario,
        'id_equipo' => $request->id_equipo,
        'posicion' => $request->posicion,
        'numero_camiseta' => $request->numero_camiseta,
        'estado' => $request->estado,
    ]);

    return redirect()->route('jugadores.index')
                     ->with('success', 'Jugador creado correctamente.');
    }
}
