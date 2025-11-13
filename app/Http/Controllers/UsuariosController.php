<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    // Mostrar roles + búsqueda
    public function index(Request $request){
        $search = $request->input('search');
        $query = DB::table('usuarios');

        if($search){
            $query->where(function ($q) use($search){
                $q->where('id_usuario','LIKE',"%{$search}%")
                  ->orWhere('nombre','LIKE',"%{$search}%")
                  ->orWhere('apellido','LIKE',"%{$search}%")
                  ->orWhere('correo','LIKE',"%{$search}%")
                  ->orWhere('id_rol','LIKE',"%{$search}%")
                  ->orWhere('fecha_registro','LIKE',"%{$search}%")
                  ->orWhere('fecha_nacimiento','LIKE',"%{$search}%")
                  ->orWhere('estado','LIKE',"%{$search}%");
            });
        }

        $datos = $query->paginate(10);
        return view("usuarios")->with("datos", $datos);
    }

    // Crear nuevo rol
    public function store(Request $request){
        $request->validate([
            'id_usuario' => 'required|unique:torneos,id_torneo',
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required',
            'id_rol' => 'required',
            'fecha_registro' => 'required',
            'fecha_nacimiento' => 'required',
            'estado' => 'required',
        ]);

        usuariosModelo::create($request->all());
        return redirect()->route('torneos.index')->with('success','Usuario registrado correctamente');
    }

    // Actualizar (modificar)
    public function update(Request $request, $id_usuario){
        $usuarios = usuariosModelo::findOrFail($id_usuario);
        $usuarios->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'id_rol' => $request->id_rol,
            'fecha_registro' => $request->fecha_registro,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'estado' => $request->estado,
        ]);
        return redirect()->route('usuarios.index')->with('success','Usuario actualizado correctamente');
    }

    // Eliminar
    public function destroy($id_usuario){
        $usuarios = usuariosModelo::findOrFail($id_usuario);
        $usuarios->delete();
        return redirect()->route('usuarios.index')->with('success','Usuario eliminado correctamente');
        
    }
}
