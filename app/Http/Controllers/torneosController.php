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
        $query = DB::table('torneos');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id_torneo', 'LIKE', "%{$search}%")
                    ->orWhere('nombre_torneo', 'LIKE', "%{$search}%")
                    ->orWhere('fecha_inicio', 'LIKE', "%{$search}%")
                    ->orWhere('fecha_fin', 'LIKE', "%{$search}%")
                    ->orWhere('ciudad', 'LIKE', "%{$search}%")
                    ->orWhere('id_categoria', 'LIKE', "%{$search}%")
                    ->orWhere('id_usuario', 'LIKE', "%{$search}%")
                    ->orWhere('estado', 'LIKE', "%{$search}%");
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
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'ciudad' => 'required',
            'id_categoria' => 'required',
            'id_usuario' => 'required',
            'estado' => 'required',
        ]);

        Torneo::create($request->all());

        return redirect()->route('torneos.index')->with('success', 'Torneo registrado correctamente');
    }

    public function update(Request $request, $id_torneo)
    {
        $torneo = Torneo::findOrFail($id_torneo);

        $torneo->update([
            'nombre_torneo' => $request->nombre_torneo,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'ciudad' => $request->ciudad,
            'id_categoria' => $request->id_categoria,
            'id_usuario' => $request->id_usuario,
            'estado' => $request->estado,
        ]);

        return redirect()->route('torneos.index')->with('success', 'Torneo actualizado correctamente');
    }

    public function destroy($id_torneo)
    {
        $torneo = Torneo::findOrFail($id_torneo);
        $torneo->delete();

        return redirect()->route('torneos.index')->with('success', 'Torneo eliminado correctamente');
    }
}
