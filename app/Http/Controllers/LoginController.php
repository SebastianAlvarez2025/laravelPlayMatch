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
        // Validación de campos
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required|string'
        ]);

        // Buscar el usuario por correo
        $usuario = DB::table('usuarios')
            ->where('correo', $request->correo)
            ->first();

        // Verificar si el correo existe
        if (!$usuario) {
            return back()->withErrors([
                'correo' => 'El correo no existe.'
            ])->withInput();
        }

        // Verificar la contraseña
        if (!Hash::check($request->password, $usuario->password)) {
            return back()->withErrors([
                'password' => 'La contraseña es incorrecta.'
            ])->withInput();
        }

        // Regenerar la sesión para evitar ataques de fijación
        $request->session()->regenerate();

        // Guardar datos del usuario en sesión (CORREGIDO)
        $request->session()->put('user', [
            'id'     => $usuario->id_usuario,  // ID del usuario
            'nombre' => $usuario->nombre,      // Nombre del usuario
            'correo' => $usuario->correo,      // Correo
            'id_rol' => $usuario->id_rol       // <-- ESTA ES LA CLAVE QUE EL MENÚ UTILIZA
        ]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        // Eliminar datos de sesión
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
