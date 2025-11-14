<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\jugadoresModelo;

class jugadoresController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');


        $query = DB::table('jugadores')

        ->join('usuarios', 'jugadores.id_usuario', '=', 'usuarios.id_usuario')
        ->join('equipos', 'jugadores.id_equipo', '=', 'equipos.id_equipo')
        ->select(
            'jugadores.*',
            'usuarios.nombre as usuario_nombre',
            'usuarios.apellido as usuario_apellido',
            'equipos.nombre_equipo as equipo_nombre'
        );

    if($search){
        $query->where(function ($q) use($search){
            $q->where('jugadores.id_jugador','LIKE',"%{$search}%")
              ->orWhere('jugadores.id_usuario','LIKE',"%{$search}%")
              ->orWhere('usuarios.nombre','LIKE',"%{$search}%")
              ->orWhere('usuarios.apellido','LIKE',"%{$search}%")
              ->orWhere('jugadores.id_equipo','LIKE',"%{$search}%")
              ->orWhere('equipos.nombre_equipo','LIKE',"%{$search}%")
              ->orWhere('jugadores.numero_camiseta','LIKE',"%{$search}%")
              ->orWhere('jugadores.posicion','LIKE',"%{$search}%")
              ->orWhere('jugadores.estado','LIKE',"%{$search}%");
        });
    }
        $datos = $query->paginate(10)->appends($request->only('search'));

        $equipos = DB::table('equipos')->get();
        $usuarios = DB::table('usuarios')->get();

        return view("jugadores", compact('datos', 'equipos', 'usuarios'));
    }
    
    public function create(){
    $equipos = DB::table('equipos')->get(); 
    $usuarios = DB::table('usuarios')->get();

    return view('jugadores.create', compact('equipos', 'usuarios'));
    }

    //Crear
    public function store(Request $request){
        $request -> validate([
            'id_jugador' => 'required|unique:jugadores,id_jugador',
            'id_usuario' => 'required|unique:jugadores,id_usuario',
            'id_equipo'  => 'required',
            'posicion' => 'required',
            'numero_camiseta' => 'required',
            'estado' => 'required',
        ]);

        jugadoresModelo::create($request->all());

        return redirect()->route('jugadores.index')
                     ->with('success', 'Jugador creado correctamente.');
    }

    //Actualizar
    public function update(Request $request, $id_jugador){
        $jugador = jugadoresModelo::findOrFail($id_jugador);
        $jugador ->update([
            'id_equipo' => $request->id_equipo,
            'posicion' => $request->posicion,
            'numero_camiseta' => $request->numero_camiseta,
            'estado' => $request->estado,
        ]);
        return redirect()->route('jugadores.index')->with('success','Jugador actualizado correctamente');
    }

    // Eliminar
    public function destroy($id_jugador){
        $jugador = jugadoresModelo::findOrFail($id_jugador);
        $jugador ->delete();
        return redirect()->route('jugadores.index')->with('success','Lugar eliminado correctamente');
    }
}
