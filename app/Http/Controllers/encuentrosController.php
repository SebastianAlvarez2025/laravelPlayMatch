<?php

namespace App\Http\Controllers;

use App\Models\Encuentro;
use App\Models\fechasModelo;
use App\Models\torneoModel;
use App\Models\lugaresModelo;
use App\Models\equipo;
use App\Models\arbitrosModelo;
use Illuminate\Http\Request;

class encuentrosController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $datos = Encuentro::with(['fechaInfo', 'torneo', 'lugar', 'equipo', 'arbitro'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('fechaInfo', function ($q) use ($search) {
                    $q->where('fecha', 'LIKE', "%$search%");
                });
            })
            ->orderByDesc('id_encuentro')
            ->paginate(10);

        return view('encuentros.index', [
            'datos'     => $datos,
            'torneos'   => torneoModel::all(),
            'lugares'   => lugaresModelo::all(),
            'equipos'   => equipo::all(),
            'arbitros'  => arbitrosModelo::all(),
        ]);
    }

    public function store(Request $request)
    {
        Encuentro::create($request->all());
        return back()->with('success', 'Encuentro creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $encuentro = Encuentro::find($id);
        $encuentro->update($request->all());

        // actualizar fecha en tabla fechas
        $fecha = fechasModelo::find($encuentro->id_fecha);
        if ($fecha) {
            $fecha->fecha = $request->fecha;
            $fecha->save();
        }

        return back()->with('success', 'Encuentro actualizado correctamente.');
    }

    public function destroy($id)
    {
        Encuentro::destroy($id);
        return back()->with('success', 'Encuentro eliminado.');
    }
}
