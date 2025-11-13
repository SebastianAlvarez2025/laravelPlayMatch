<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EncuentrosController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->get('search');

        $datos = DB::table('encuentros')
            ->when($buscar, function ($query, $buscar) {
                return $query->where('id_torneo', 'LIKE', "%{$buscar}%")
                             ->orWhere('id_lugar', 'LIKE', "%{$buscar}%");
            })
            ->paginate(10);

        return view('encuentros', compact('datos'));
    }


    // Guarda
    public function store(Request $request)
    {
        DB::table('encuentros')->insert([
            'id_encuentro' => $request->id_encuentro,
            'id_fecha' => $request->id_fecha,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'id_torneo' => $request->id_torneo,
            'id_lugar' => $request->id_lugar,
            'id_equipo' => $request->id_equipo,
            'id_arbitro_principal' => $request->id_arbitro_principal,
        ]);

        return redirect()->route('encuentros.index');
    }

    // Actualiza
    public function update(Request $request, $id)
    {
        DB::table('encuentros')->where('id_encuentro', $id)->update([
            'id_fecha' => $request->id_fecha,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'id_torneo' => $request->id_torneo,
            'id_lugar' => $request->id_lugar,
            'id_equipo' => $request->id_equipo,
            'id_arbitro_principal' => $request->id_arbitro_principal,
        ]);

        return redirect()->route('encuentros.index');
    }

    // Elimina
    public function destroy($id)
    {
        DB::table('encuentros')->where('id_encuentro', $id)->delete();
        return redirect()->route('encuentros.index');
    }
}
