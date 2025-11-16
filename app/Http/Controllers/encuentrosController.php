<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuentro;
use App\Models\torneoModel;  
use App\Models\lugaresmodelo;     
use App\Models\equiposModelos;  
use App\Models\arbitrosModelo;  

class EncuentrosController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->get('search');

        $datos = Encuentro::select(
                'encuentros.*',
                'torneos.nombre_torneo',
                'lugares.nombre_lugar',
                'equipos.nombre_equipo',
                'arbitros.id_arbitro'
            )
            ->leftJoin('torneos', 'encuentros.id_torneo', '=', 'torneos.id_torneo')
            ->leftJoin('lugares', 'encuentros.id_lugar', '=', 'lugares.id_lugar')
            ->leftJoin('equipos', 'encuentros.id_equipo', '=', 'equipos.id_equipo')
            ->leftJoin('arbitros', 'encuentros.id_arbitro', '=', 'arbitros.id_arbitro')
            ->where(function ($query) use ($buscar) {
                if ($buscar) {
                    $query->where('torneos.nombre_torneo', 'like', "%$buscar%")
                          ->orWhere('lugares.nombre_lugar', 'like', "%$buscar%")
                          ->orWhere('equipos.nombre_equipo', 'like', "%$buscar%")
                          ->orWhere('encuentros.fecha', 'like', "%$buscar%");
                }
            })
            ->paginate(10);

    
        $torneos = torneoModel::all();      
        $lugares = lugaresModelo::all();    
        $equipos = equiposModelos::all();  
        $arbitros = arbitrosModelo::all(); 

        return view('encuentros', compact('datos', 'torneos', 'lugares', 'equipos', 'arbitros'));
    }
}