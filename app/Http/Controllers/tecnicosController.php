<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tecnicosController extends Controller
{
    // Mostrar roles + búsqueda
    public function index(Request $request){
        $search = $request->input('search');
        $query = DB::table('tecnicos');

        if($search){
            $query->where(function ($q) use($search){
                $q->where('id_tecnico','LIKE',"%{$search}%")
                  ->orWhere('id_usuario','LIKE',"%{$search}%")
                  ->orWhere('id_equipo','LIKE',"%{$search}%")
                  ->orWhere('licencia','LIKE',"%{$search}%")
                  ->orWhere('fecha_inicio','LIKE',"%{$search}%");
            });
        }

        $datos = $query->paginate(10);
        return view("tecnicos")->with("datos", $datos);
    }

    // Crear nuevo rol
    public function store(Request $request){
        $request->validate([
            'id_tecnico' => 'required|unique:tecnicos,id_tecnico',
            'id_usuario' => 'required',
            'id_equipo' => 'required',
            'licencia' => 'required',
            'fecha_inicio' => 'required',
        ]);

        tecnicosModelo::create($request->all());
        return redirect()->route('tecnicos.index')->with('success','Tecnico registrado correctamente');
    }

    // Actualizar (modificar)
    public function update(Request $request, $id_tecnico){
        $torneos = tecnicosModelo::findOrFail($id_tecnico);
        $torneos->update([
            'id_usuario' => $request->id_usuario,
            'id_equipo' => $request->id_equipo,
            'licencia' => $request->licencia,
            'fecha_inicio' => $request->fecha_inicio,
            
        ]);
        return redirect()->route('tecnicos.index')->with('success','Tecnico actualizado correctamente');
    }

    // Eliminar
    public function destroy($id_tecnico){
        $tipo_falta = tecnicosModelo::findOrFail($id_tecnico);
        $tipo_falta->delete();
        return redirect()->route('tecnicos.index')->with('success','Tecnico  eliminado correctamente');
    }
}

