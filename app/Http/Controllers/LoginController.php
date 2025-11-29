<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use app\http\Controllers\Usuarios;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required|string'
        ]);

        $usuario = DB::table('usuarios')
                    ->where('correo', $request->correo)
                    ->first();

        if (!$usuario) {
            return back()->withErrors(['correo' => 'El correo no existe.'])->withInput();
        }

        if (!Hash::check($request->password, $usuario->password)) {
            return back()->withErrors(['password' => 'La contraseña es incorrecta.'])->withInput();
        }

        $request->session()->regenerate();

        $request->session()->put('user', [
            'id' => $usuario->id_usuario,
            'nombre' => $usuario->nombre,
            'correo' => $usuario->correo,
            'id_rol' => $usuario->id_rol
        ]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
