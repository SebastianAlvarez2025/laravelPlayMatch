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
            ->join('categorias', 'equipos.id_categoria', '=', 'categorias.id_categoria')
            ->select('equipos.*', 'categorias.nombre_categoria')
            ->when($search, function ($query, $search) {
                return $query->where('nombre_equipo', 'LIKE', "%{$search}%")
                             ->orWhere('ciudad', 'LIKE', "%{$search}%");
            })
            ->orderBy('id_equipo', 'asc')
            ->paginate(10);

        // PARA SELECT EN MODAL CREAR Y EDITAR
        $categorias = DB::table('categorias')->get();

        return view('equipos', compact('datos', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_equipo' => 'required',
            'ciudad' => 'required',
            'id_categoria' => 'required',
            'estado' => 'required',
        ]);

        DB::table('equipos')->insert([
            'nombre_equipo' => $request->nombre_equipo,
            'ciudad'        => $request->ciudad,
            'id_categoria'  => $request->id_categoria,
            'escudo_url'    => $request->escudo_url,
            'estado'        => $request->estado,
        ]);

        return redirect()->route('equipos.index');
    }

    public function update(Request $request, $id)
    {
        DB::table('equipos')->where('id_equipo', $id)->update([
            'nombre_equipo' => $request->nombre_equipo,
            'ciudad'        => $request->ciudad,
            'id_categoria'  => $request->id_categoria,
            'escudo_url'    => $request->escudo_url,
            'estado'        => $request->estado,
        ]);

        return redirect()->route('equipos.index');
    }

    public function destroy($id)
    {
        DB::table('equipos')->where('id_equipo', $id)->delete();
        return redirect()->route('equipos.index');
    }
}
