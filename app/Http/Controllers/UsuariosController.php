<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\usuariosModelo;

class UsuariosController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = DB::table('usuarios');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id_usuario', 'LIKE', "%{$search}%")
                    ->orWhere('nombre', 'LIKE', "%{$search}%")
                    ->orWhere('apellido', 'LIKE', "%{$search}%")
                    ->orWhere('correo', 'LIKE', "%{$search}%")
                    ->orWhere('id_rol', 'LIKE', "%{$search}%")
                    ->orWhere('fecha_registro', 'LIKE', "%{$search}%")
                    ->orWhere('fecha_nacimiento', 'LIKE', "%{$search}%")
                    ->orWhere('estado', 'LIKE', "%{$search}%");
            });
        }

        $datos = $query->paginate(10);
        return view("usuarios")->with("datos", $datos);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|unique:usuarios,id_usuario',
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|email',
            'password' => 'required',
            'id_rol' => 'required',
            'fecha_registro' => 'required',
            'fecha_nacimiento' => 'required',
            'estado' => 'required',
        ]);

        usuariosModelo::create([
            'id_usuario' => $request->id_usuario,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'password' => Hash::make($request->password), 
            'id_rol' => $request->id_rol,
            'fecha_registro' => $request->fecha_registro,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'estado' => $request->estado,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado correctamente');
    }

    public function update(Request $request, $id_usuario)
    {
        $usuario = usuariosModelo::findOrFail($id_usuario);

        $password = $usuario->password;
        if ($request->password) {
            $password = Hash::make($request->password);
        }

        $usuario->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'password' => $password,
            'id_rol' => $request->id_rol,
            'fecha_registro' => $request->fecha_registro,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'estado' => $request->estado,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    // Eliminar
    public function destroy($id_usuario)
    {
        $usuario = usuariosModelo::findOrFail($id_usuario);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }
}
