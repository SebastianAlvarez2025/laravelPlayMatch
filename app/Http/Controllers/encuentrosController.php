<?php

namespace App\Http\Controllers;

use App\Models\Encuentro;
use App\Models\fechasModelo;       // ✔ Correcto
use App\Models\Torneo;
use App\Models\lugaresModelo;      // ✔ Correcto
use App\Models\arbitrosModelo;     // ✔ Correcto
use App\Models\Equipo;
use Illuminate\Http\Request;

class EncuentrosController extends Controller
{
    public function index()
    {
        // Obtener datos para el formulario
        $fechas = fechasModelo::all();
        $torneos = Torneo::all();
        $lugares = lugaresModelo::all();
        $arbitros = arbitrosModelo::all();
        $equipos = Equipo::all();

        // Cargar encuentros con relaciones
        $datos = Encuentro::with([
            'fecha',
            'torneo',
            'lugar',
            'arbitro',
            'equipoLocal',
            'equipoVisitante'
        ])->get();

        return view('encuentros', compact(
            'fechas',
            'torneos',
            'lugares',
            'arbitros',
            'equipos',
            'datos'
        ));
    }

    public function crear(Request $request)
    {
        Encuentro::create($request->all());
        return back()->with('success', 'Encuentro creado correctamente');
    }

    public function eliminar($id)
    {
        Encuentro::where('id_encuentro', $id)->delete();
        return back()->with('success', 'Encuentro eliminado correctamente');
    }
}