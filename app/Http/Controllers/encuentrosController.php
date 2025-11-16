<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuentro;
use App\Models\torneoModel;  
use App\Models\lugaresModelo;     
use App\Models\equiposModelos;  
use App\Models\arbitrosModelo;  

class EncuentrosController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->get('search');

        // Consulta optimizada con relaciones
        $datos = Encuentro::with(['torneo', 'lugar', 'equipo', 'arbitro'])
            ->when($buscar, function($query) use ($buscar) {
                return $query->where(function($q) use ($buscar) {
                    $q->where('fecha', 'like', "%$buscar%")
                      ->orWhereHas('torneo', function($subq) use ($buscar) {
                          $subq->where('nombre_torneo', 'like', "%$buscar%");
                      })
                      ->orWhereHas('lugar', function($subq) use ($buscar) {
                          $subq->where('nombre_lugar', 'like', "%$buscar%");
                      })
                      ->orWhereHas('equipo', function($subq) use ($buscar) {
                          $subq->where('nombre_equipo', 'like', "%$buscar%");
                      });
                });
            })
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        // Datos para los selects
        $torneos = torneoModel::all();      
        $lugares = lugaresModelo::all();    
        $equipos = equiposModelos::all();  
        $arbitros = arbitrosModelo::all(); 

        return view('encuentros', compact('datos', 'torneos', 'lugares', 'equipos', 'arbitros'));
    }

    public function create()
    {
        // El formulario de crear está en el modal de la vista
        return redirect()->route('encuentros.index');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_fecha' => 'required|integer',
                'fecha' => 'required|date',
                'hora' => 'required',
                'id_torneo' => 'required|integer',
                'id_lugar' => 'required|integer',
                'id_equipo' => 'required|integer',
                'id_arbitro' => 'required|integer',
            ]);

            Encuentro::create($request->all());

            return redirect()->route('encuentros.index')
                ->with('success', '✅ Encuentro creado exitosamente.');

        } catch (\Exception $e) {
            return redirect()->route('encuentros.index')
                ->with('error', '❌ Error al crear el encuentro: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        // No necesario para este módulo
        return redirect()->route('encuentros.index');
    }

    public function edit($id)
    {
        // El formulario de editar está en el modal de la vista
        return redirect()->route('encuentros.index');
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_fecha' => 'required|integer',
                'fecha' => 'required|date',
                'hora' => 'required',
                'id_torneo' => 'required|integer',
                'id_lugar' => 'required|integer',
                'id_equipo' => 'required|integer',
                'id_arbitro' => 'required|integer',
            ]);

            $encuentro = Encuentro::findOrFail($id);
            $encuentro->update($request->all());

            return redirect()->route('encuentros.index')
                ->with('success', '✅ Encuentro actualizado exitosamente.');

        } catch (\Exception $e) {
            return redirect()->route('encuentros.index')
                ->with('error', '❌ Error al actualizar el encuentro: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $encuentro = Encuentro::findOrFail($id);
            $encuentro->delete();

            return redirect()->route('encuentros.index')
                ->with('success', '✅ Encuentro eliminado exitosamente.');

        } catch (\Exception $e) {
            return redirect()->route('encuentros.index')
                ->with('error', '❌ Error al eliminar el encuentro: ' . $e->getMessage());
        }
    }
}