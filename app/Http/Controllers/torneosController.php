<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class torneosController extends Controller
{
<<<<<<< Updated upstream
    public function index(){
        $datos = DB::select("select * from torneos");
        return view("torneos")->with("datos", $datos);
=======
    // Mostrar roles + búsqueda
    public function index(Request $request){
        $search = $request->input('search');
        $query = DB::table('torneos');

        if($search){
            $query->where(function ($q) use($search){
                $q->where('id_torneo','LIKE',"%{$search}%")
                  ->orWhere('nombre_torneo','LIKE',"%{$search}%")
                  ->orWhere('fecha_inicio','LIKE',"%{$search}%")
                  ->orWhere('fecha_fin','LIKE',"%{$search}%")
                  ->orWhere('ciudad','LIKE',"%{$search}%")
                  ->orWhere('id_categoria','LIKE',"%{$search}%")
                  ->orWhere('id_usuario','LIKE',"%{$search}%")
                  ->orWhere('estado','LIKE',"%{$search}%");
            });
        }

        $datos = $query->paginate(10);
        return view("torneos")->with("datos", $datos);
    }

    // Crear nuevo rol
    public function store(Request $request){
        $request->validate([
            'id_torneo' => 'required|unique:torneos,id_torneo',
            'nombre_torneo' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'ciudad' => 'required',
            'id_categoria' => 'required',
            'id_usuario' => 'required',
            'estado' => 'required',
        ]);

        torneosModelo::create($request->all());
        return redirect()->route('torneos.index')->with('success','Torneo registrado correctamente');
    }

    // Actualizar (modificar)
    public function update(Request $request, $id_torneo){
        $torneos = torneosModelo::findOrFail($id_torneo);
        $torneos->update([
            'nombre_torneo' => $request->nombrerol,
            'fecha_fin' => $request->nombrerol,
            'ciudad' => $request->nombrerol,
            'id_categoria' => $request->nombrerol,
            'id_usuario' => $request->nombrerol,
            'estado' => $request->descripcion,
        ]);
        return redirect()->route('torneos.index')->with('success','Torneo actualizado correctamente');
    }

    // Eliminar
    public function destroy($id_torneo){
        $torneos = tornosModelo::findOrFail($id_torneos);
        $torneos->delete();
        return redirect()->route('torneos.index')->with('success','Torneo eliminado correctamente');
>>>>>>> Stashed changes
    }
}








