<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\resultadosModelo;

class resultadosController extends Controller
{
    // Mostrar resultados + búsqueda
    public function index(Request $request){
        $search = $request->input('search');
        $query = DB::table('resultados');

        if($search){
            $query->where(function ($q) use($search){
                $q->where('id_resultado','LIKE',"%{$search}%")
                  ->orWhere('id_encuentro','LIKE',"%{$search}%")
                  ->orWhere('goles_local','LIKE',"%{$search}%")
                  ->orWhere('goles_visitante','LIKE',"%{$search}%")
                  ->orWhere('ganador','LIKE',"%{$search}%")
                  ->orWhere('observaciones','LIKE',"%{$search}%");
            });
        }

        $datos = $query->paginate(10);
        return view("resultados")->with("datos", $datos);
    }

    // Crear nuevo rol
    public function store(Request $request){
        $request->validate([
            'id_resultado' => 'required|unique:resultados,id_resultado',
            'id_encuentro' => 'required',
            'goles_local' => 'required',
            'goles_visitante' => 'required',
            'ganador' => 'required',
            'observaciones' => 'required',
        ]);

        resultadosModelo::create($request->all());
        return redirect()->route('resultados.index')->with('success','Resultado registrado correctamente');
    }

    // Actualizar (modificar)
    public function update(Request $request, $id_resultado){
        $resultado = resultadosModelo::findOrFail($id_resultado);
        $resultado->update([
            'id_encuentro' => $request->id_encuentro,
            'goles_local' => $request->goles_local,
            'goles_visitante' => $request->goles_visitante,
            'ganador' => $request->ganador,
            'observaciones' => $request->observaciones,
        ]);
        return redirect()->route('resultados.index')->with('success','Resultado actualizado correctamente');
    }

    // Eliminar
    public function destroy($id_resultado){
        $resultado = resultadosModelo::findOrFail($id_resultado);
        $resultado->delete();
        return redirect()->route('resultados.index')->with('success','Resultado eliminado correctamente');
    }
    
}