<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Premiacion;

class PremiacionController extends Controller
{
    // Listar + buscar
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('premiacion')
        ->join('equipos', 'equipos.id_equipo', '=', 'premiacion.id_equipo')
        ->select('premiacion.*', 'equipos.nombre_equipo');

        if ($search) {
    $query->where(function ($q) use ($search) {
        $q->where('premiacion.id_premiacion', 'LIKE', "%{$search}%")
          ->orWhere('equipos.nombre_equipo', 'LIKE', "%{$search}%")
          ->orWhere('premiacion.posicion', 'LIKE', "%{$search}%")
          ->orWhere('premiacion.premio', 'LIKE', "%{$search}%");
    });
}

    $datos = $query->paginate(10);

        return view('premiacion', compact('datos', 'search'));
    }

    // Guardar premiación
    public function store(Request $request)
    {
        $request->validate([
            'id_premiacion' => 'required|unique:premiacion,id_premiacion',
            'id_torneo' => 'required',
            'id_equipo' => 'required',
            'posicion' => 'required',
            'premio' => 'required',
            'descripcion' => 'required',
        ]);

        Premiacion::create($request->only([
            'id_premiacion',
            'id_torneo',
            'id_equipo',
            'posicion',
            'premio',
            'descripcion',
        ]));

        return redirect()->route('premiacion.index')
            ->with('success', 'Premiación registrada correctamente');
    }

    // Actualizar premiación
    public function update(Request $request, $id_premiacion)
    {
        $premiacion = Premiacion::findOrFail($id_premiacion);

        $request->validate([
            'id_torneo' => 'required',
            'id_equipo' => 'required',
            'posicion' => 'required',
            'premio' => 'required',
            'descripcion' => 'required',
        ]);

        $premiacion->update($request->only([
            'id_torneo',
            'id_equipo',
            'posicion',
            'premio',
            'descripcion',
        ]));

        return redirect()->route('premiacion.index')
            ->with('success', 'Premiación actualizada correctamente');
    }

    // Eliminar premiación
    public function destroy($id_premiacion)
    {
        $premiacion = Premiacion::findOrFail($id_premiacion);
        $premiacion->delete();

        return redirect()->route('premiacion.index')
            ->with('success', 'Premiación eliminada correctamente');
    }
}
