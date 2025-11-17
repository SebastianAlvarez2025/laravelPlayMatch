<?php

namespace App\Http\Controllers;

use App\Models\Arbitro;
use Illuminate\Http\Request;

class ArbitrosController extends Controller
{
    // Listar con búsqueda y paginación
    public function index(Request $request)
    {
        $buscar = $request->get('search');

        $datos = Arbitro::query()
            ->when($buscar, function ($query, $buscar) {
                $query->where(function($q) use ($buscar) {
                    $q->where('categoria_arbitral', 'LIKE', "%{$buscar}%")
                      ->orWhere('licencia', 'LIKE', "%{$buscar}%");
                });
            })
            ->paginate(10);

        return view('arbitros', compact('datos'));
    }

    // Guardar
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|integer',
            'licencia' => 'required|string|max:50',
            'anos_experiencia' => 'required|integer|min:0',
            'categoria_arbitral' => 'required|string|max:50',
        ]);

        Arbitro::create($request->all());

        return redirect()->route('arbitros.index')->with('success', 'Árbitro registrado correctamente.');
    }

    // Actualizar
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_usuario' => 'required|integer',
            'licencia' => 'required|string|max:50',
            'anos_experiencia' => 'required|integer|min:0',
            'categoria_arbitral' => 'required|string|max:50',
        ]);

        $arbitro = Arbitro::findOrFail($id);
        $arbitro->update($request->all());

        return redirect()->route('arbitros.index')->with('success', 'Árbitro actualizado correctamente.');
    }

    // Eliminar
    public function destroy($id)
    {
        $arbitro = Arbitro::findOrFail($id);
        $arbitro->delete();

        return redirect()->route('arbitros.index')->with('success', 'Árbitro eliminado correctamente.');
    }
}
