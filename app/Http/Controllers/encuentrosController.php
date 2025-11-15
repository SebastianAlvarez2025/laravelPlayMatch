<?php

namespace App\Http\Controllers;

use App\Models\Encuentro;
use Illuminate\Http\Request;

class EncuentrosController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->get('search');

        $datos = Encuentro::when($buscar, function($query, $buscar) {
            return $query->where('id_encuentro', 'like', "%$buscar%")
                         ->orWhere('id_fecha', 'like', "%$buscar%")
                         ->orWhere('fecha', 'like', "%$buscar%")
                         ->orWhere('id_torneo', 'like', "%$buscar%")
                         ->orWhere('id_equipo', 'like', "%$buscar%");
        })->paginate(10);

        return view('encuentros', compact('datos'));
    }

    public function store(Request $request)
    {
        Encuentro::create([
            'id_fecha'      => $request->id_fecha,
            'fecha'         => $request->fecha,
            'hora'          => $request->hora,
            'id_torneo'     => $request->id_torneo,
            'id_lugar'      => $request->id_lugar,
            'id_equipo'     => $request->id_equipo,
            'id_arbitro'    => $request->id_arbitro_principal
        ]);

        return redirect()->route('encuentros.index');
    }

    public function update(Request $request, $id)
    {
        $encuentro = Encuentro::findOrFail($id);

        $encuentro->update([
            'id_fecha'      => $request->id_fecha,
            'fecha'         => $request->fecha,
            'hora'          => $request->hora,
            'id_torneo'     => $request->id_torneo,
            'id_lugar'      => $request->id_lugar,
            'id_equipo'     => $request->id_equipo,
            'id_arbitro'    => $request->id_arbitro
        ]);

        return redirect()->route('encuentros.index');
    }

    public function destroy($id)
    {
        $encuentro = Encuentro::findOrFail($id);
        $encuentro->delete();

        return redirect()->route('encuentros.index');
    }
}
