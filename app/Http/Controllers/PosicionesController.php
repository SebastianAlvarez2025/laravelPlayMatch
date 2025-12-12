<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posicion;

class PosicionesController extends Controller
{
    // Listar posiciones
    public function index(Request $request)
    {
        $search = $request->get('search', '');

        $datos = Posicion::query()
            ->when($search, function($query, $search) {
                $query->where('nombre_equipo', 'like', "%$search%")
                      ->orWhere('nombre_torneo', 'like', "%$search%");
            })
            ->paginate(10);

        return view('posiciones.index', compact('datos'));
    }

    // Guardar nueva posicion
    public function store(Request $request)
    {
        Posicion::create($request->all());
        return redirect()->route('posiciones.index')->with('success', 'Posición creada correctamente');
    }

    // Actualizar
    public function update(Request $request, $id)
    {
        $posicion = Posicion::findOrFail($id);
        $posicion->update($request->all());
        return redirect()->route('posiciones.index')->with('success', 'Posición actualizada correctamente');
    }

    // Eliminar
    public function destroy($id)
    {
        $posicion = Posicion::findOrFail($id);
        $posicion->delete();
        return redirect()->route('posiciones.index')->with('success', 'Posición eliminada correctamente');
    }
}
