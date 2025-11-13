<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class equiposController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $datos = DB::table('equipos')
            ->when($search, function ($query, $search) {
                return $query->where('nombre_equipo', 'LIKE', "%{$search}%")
                             ->orWhere('ciudad', 'LIKE', "%{$search}%");
            })
            ->orderBy('id_equipo', 'asc')
            ->paginate(10);

        return view('equipos', compact('datos'));
    }

    // Guarda
    public function store(Request $request)
    {
        DB::table('equipos')->insert([
            'nombre_equipo' => $request->nombre_equipo,
            'ciudad' => $request->ciudad,
            'id_categoria' => $request->id_categoria,
            'escudo_url' => $request->escudo_url,
            'estado' => $request->estado,
        ]);

        return redirect()->route('equipos.index');
    }

    // Actualiza
    public function update(Request $request, $id)
    {
        DB::table('equipos')->where('id_equipo', $id)->update([
            'nombre_equipo' => $request->nombre_equipo,
            'ciudad' => $request->ciudad,
            'id_categoria' => $request->id_categoria,
            'escudo_url' => $request->escudo_url,
            'estado' => $request->estado,
        ]);

        return redirect()->route('equipos.index');
    }

    // Elimina
    public function destroy($id)
    {
        DB::table('equipos')->where('id_equipo', $id)->delete();
        return redirect()->route('equipos.index');
    }
}
