<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuentro;
use App\Models\Torneo;
use App\Models\Lugar;
use App\Models\Equipo;
use App\Models\Arbitro;

class EncuentrosController extends Controller
{
    // Mostrar todos los encuentros con búsqueda
    public function index(Request $request)
    {
        $buscar = $request->get('search');

        $datos = Encuentro::with(['torneo', 'lugar', 'equipo', 'arbitro'])
            ->when($buscar, function ($query, $buscar) {
                $query->whereHas('torneo', fn($q) => $q->where('nombre', 'LIKE', "%{$buscar}%"))
                      ->orWhereHas('lugar', fn($q) => $q->where('nombre', 'LIKE', "%{$buscar}%"));
            })
            ->paginate(10);

        // Datos para los <select>
        $torneos = Torneo::all();
        $lugares = Lugar::all();
        $equipos = Equipo::all();
        $arbitros = Arbitro::all();

        return view('encuentros', compact('datos', 'torneos', 'lugares', 'equipos', 'arbitros'));
    }

    // Crear nuevo encuentro
    public function store(Request $request)
    {
        Encuentro::create($request->all());
        return redirect()->route('encuentros.index');
    }

    // Actualizar encuentro existente
    public function update(Request $request, $id)
    {
        $encuentro = Encuentro::findOrFail($id);
        $encuentro->update($request->all());
        return redirect()->route('encuentros.index');
    }

    // Eliminar encuentro
    public function destroy($id)
    {
        $encuentro = Encuentro::findOrFail($id);
        $encuentro->delete();
        return redirect()->route('encuentros.index');
    }
}
