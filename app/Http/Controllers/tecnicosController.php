<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tecnicosModelo;

class TecnicosController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('tecnicos')
            ->join('equipos', 'tecnicos.id_equipo', '=', 'equipos.id_equipo')
            ->select(
                'tecnicos.id_tecnico',
                'tecnicos.id_usuario',
                'equipos.nombre_equipo as equipo',
                'tecnicos.licencia'
            );

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('tecnicos.id_tecnico', 'LIKE', "%{$search}%")
                  ->orWhere('tecnicos.id_usuario', 'LIKE', "%{$search}%")
                  ->orWhere('equipos.nombre_equipo', 'LIKE', "%{$search}%")
                  ->orWhere('tecnicos.licencia', 'LIKE', "%{$search}%");
            });
        }

        $datos = $query->paginate(10);

        return view('tecnicos', compact('datos'));
    }

   
    
    public function store(Request $request)
    {
        $request->validate([
            'id_tecnico' => 'required|unique:tecnicos,id_tecnico',
            'id_usuario' => 'required',
            'id_equipo'  => 'required',
            'licencia'   => 'required'
        ]);

        tecnicosModelo::create($request->all());

        return redirect()->route('tecnicos.index')
            ->with('success', 'Técnico registrado correctamente');
    }

   
    
    public function update(Request $request, $id_tecnico)
    {
        $tecnico = tecnicosModelo::findOrFail($id_tecnico);

        $tecnico->update([
            'id_usuario' => $request->id_usuario,
            'id_equipo'  => $request->id_equipo,
            'licencia'   => $request->licencia,
        ]);

        return redirect()->route('tecnicos.index')
            ->with('success', 'Técnico actualizado correctamente');
    }

    
    
    public function destroy($id_tecnico)
    {
        $tecnico = tecnicosModelo::findOrFail($id_tecnico);
        $tecnico->delete();

        return redirect()->route('tecnicos.index')
            ->with('success', 'Técnico eliminado correctamente');
    }
}
