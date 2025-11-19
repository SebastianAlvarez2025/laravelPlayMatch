<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\torneosModelo;

class torneosController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');


        $query = DB::table('torneos')

        ->join('categorias', 'torneos.id_categoria', '=', 'categorias.id_categoria')
        ->join('usuarios', 'torneos.id_usuario', '=', 'usuarios.id_usuario')
        ->select(
            'torneos.*',
            'categorias.nombre_categoria as categoria_nombre',
            'usuarios.nombre as nombre_usuario',
            'usuarios.apellido as apellido_usuario'
        );

    if($search){
        $query->where(function ($q) use($search){
            $q->where('torneos.id_torneo','LIKE',"%{$search}%")
              ->orWhere('torneos.nombre_torneo','LIKE',"%{$search}%")
              ->orWhere('torneos.fecha_inicio','LIKE',"%{$search}%")
              ->orWhere('torneos.fecha_fin','LIKE',"%{$search}%")
              ->orWhere('torneos.ciudad','LIKE',"%{$search}%")
              ->orWhere('torneos.id_categoria','LIKE',"%{$search}%")
              ->orWhere('categorias.nombre_categoria','LIKE',"%{$search}%")
              ->orWhere('torneos.id_usuario','LIKE',"%{$search}%")
              ->orWhere('usuarios.nombre','LIKE',"%{$search}%")
              ->orWhere('usuarios.apellido','LIKE',"%{$search}%")
              ->orWhere('torneos.estado','LIKE',"%{$search}%");
        });
    }
        $datos = $query->paginate(10)->appends($request->only('search'));

        $categorias = DB::table('categorias')->get();
        $usuarios = DB::table('usuarios')->get();

        return view("torneos", compact('datos', 'categorias', 'usuarios'));
    }
    
    public function create(){
    $categorias = DB::table('categorias')->get(); 
    $usuarios = DB::table('usuarios')->get();

    return view('torneos.create', compact('categorias', 'usuarios'));
    }

    //Crear
    public function store(Request $request){
        $request -> validate([
            'id_torneo' => 'required|unique:torneos,id_torneo',
            'nombre_torneo' => 'required',
            'fecha_inicio'  => 'required',
            'fecha_fin' => 'required',
            'ciudad' => 'required',
            'id_categoria' => 'required',
            'id_usuario' => 'required',
            'estado' => 'required',
        ]);

        torneosModelo::create($request->all());

        return redirect()->route('torneos.index')
                     ->with('success', 'Torneo creado correctamente.');
    }

    //Actualizar
    public function update(Request $request, $id_torneo){
        $torneo = torneosModelo::findOrFail($id_torneo);
        $torneo ->update([
            'nombre_torneo' => $request->nombre_torneo,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'ciudad' => $request->ciudad,
            'id_categoria' => $request->id_categoria,
            'id_usuario' => $request->id_usuario,
            'estado' => $request->estado,
        ]);
        return redirect()->route('torneos.index')->with('success','Torneo actualizado correctamente');
    }

    // Eliminar
    public function destroy($id_torneo){
        $torneo = torneosModelo::findOrFail($id_torneo);
        $torneo ->delete();
        return redirect()->route('torneos.index')->with('success','Torneo eliminado correctamente');
    }
}
