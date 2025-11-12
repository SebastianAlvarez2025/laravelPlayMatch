<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class equiposController extends Controller
{
    public function index()
    {
        $datos = DB::table('equipos')->get();
        return view('equipos', compact('datos'));
    }

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

    public function destroy($id)
    {
        DB::table('equipos')->where('id_equipo', $id)->delete();
        return redirect()->route('equipos.index');
    }
}
