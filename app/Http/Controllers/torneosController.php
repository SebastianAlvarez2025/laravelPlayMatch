<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TorneosController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = DB::table('torneos')
            ->leftJoin('categorias', 'torneos.id_categoria', '=', 'categorias.id_categoria')
            ->leftJoin('usuarios', 'torneos.id_usuario', '=', 'usuarios.id_usuario')
            ->select(
                'torneos.*', 
                'categorias.nombre_categoria',
                DB::raw("CONCAT(usuarios.nombre, ' ', usuarios.apellido) as usuario_nombre_completo")
            );

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('torneos.id_torneo', 'LIKE', "%{$search}%")
                  ->orWhere('torneos.nombre_torneo', 'LIKE', "%{$search}%")
                  ->orWhere('torneos.fecha_inicio', 'LIKE', "%{$search}%")
                  ->orWhere('torneos.fecha_fin', 'LIKE', "%{$search}%")
                  ->orWhere('torneos.ciudad', 'LIKE', "%{$search}%")
                  ->orWhere('categorias.nombre_categoria', 'LIKE', "%{$search}%")
                  ->orWhere('usuarios.nombre', 'LIKE', "%{$search}%")
                  ->orWhere('usuarios.apellido', 'LIKE', "%{$search}%")
                  ->orWhere('torneos.estado', 'LIKE', "%{$search}%");
            });
        }

        $datos = $query->paginate(10);
        return view('torneos', compact('datos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_torneo' => 'required|unique:torneos,id_torneo',
            'nombre_torneo' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'ciudad' => 'required',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'estado' => 'required|in:Activo,Inactivo,Finalizado',
        ]);

        Torneo::create($request->all());

        return redirect()->route('torneos.index')->with('success', 'Torneo registrado correctamente');
    }

    public function update(Request $request, $id_torneo)
    {
        $torneo = Torneo::findOrFail($id_torneo);

        $request->validate([
            'nombre_torneo' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'ciudad' => 'required',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'estado' => 'required|in:Activo,Inactivo,Finalizado',
        ]);

        $torneo->update($request->all());

        return redirect()->route('torneos.index')->with('success', 'Torneo actualizado correctamente');
    }

    public function destroy($id_torneo)
    {
        $torneo = Torneo::findOrFail($id_torneo);
        $torneo->delete();

        return redirect()->route('torneos.index')->with('success', 'Torneo eliminado correctamente');
    }
}