<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Buscar usuario por correo
        $usuario = DB::table('usuarios')
                    ->where('correo', $request->correo)
                    ->first();

        // Validar correo
        if (!$usuario) {
            return back()->with('error', 'Correo incorrecto.'); 
        }

        // Validar contraseña con HASH
        if (!Hash::check($request->password, $usuario->password)) {
            return back()->with('error', 'Contraseña incorrecta.');
        }

        // Login correcto
        return redirect()->route('dashboard');
    }
}
