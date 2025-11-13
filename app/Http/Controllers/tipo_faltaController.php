<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tipo_faltaController extends Controller
{
    // Mostrar roles + búsqueda
    public function index(Request $request){
        $search = $request->input('search');
        $query = DB::table('tipo_falta');

        if($search){
            $query->where(function ($q) use($search){
                $q->where('id_tipo_falta','LIKE',"%{$search}%")
                  ->orWhere('nombre','LIKE',"%{$search}%")
                  ->orWhere('gravedad','LIKE',"%{$search}%")
                  ->orWhere('sancion_base','LIKE',"%{$search}%");
            });
        }

        $datos = $query->paginate(10);
        return view("tipo_falta")->with("datos", $datos);
    }

    // Crear nuevo rol
    public function store(Request $request){
        $request->validate([
            'id_tipo_falta' => 'required|unique:tipo_falta,id_tipo_falta',
            'nombre' => 'required',
            'gravedad' => 'required',
            'sancion_base' => 'required',
        ]);

        tipo_faltaModelo::create($request->all());
        return redirect()->route('tipo_falta.index')->with('success','Tipo de falta registrado correctamente');
    }

    // Actualizar (modificar)
    public function update(Request $request, $id_tipo_falta){
        $torneos = tipo_faltaModelo::findOrFail($id_tipo_falta);
        $torneos->update([
            'nombre' => $request->nombre,
            'gravedad' => $request->nombre,
            'sancion_base' => $request->nombre,
            
        ]);
        return redirect()->route('tipo_falta.index')->with('success','Tipo de falta actualizado correctamente');
    }

    // Eliminar
    public function destroy($id_tipo_falta){
        $tipo_falta = tipo_faltaModelo::findOrFail($id_tipo_falta);
        $tipo_falta->delete();
        return redirect()->route('tipo_falta.index')->with('success','Tipo de falta  eliminado correctamente');
    }
}
