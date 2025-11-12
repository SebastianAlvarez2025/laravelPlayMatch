<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
{
    public function index()
    {
        $datos = DB::table('categorias')->get(); 
        return view('categorias', compact('datos'));
    }

    public function store(Request $request)
    {
        DB::table('categorias')->insert([
            'nombre_categoria' => $request->nombre_categoria,
            'descripcion' => $request->descripcion,
            'edad_minima' => $request->edad_minima,
            'edad_maxima' => $request->edad_maxima,
        ]);

        return redirect()->route('categorias.index');
    }

    public function update(Request $request, $id)
    {
        DB::table('categorias')->where('id_categoria', $id)->update([
            'nombre_categoria' => $request->nombre_categoria,
            'descripcion' => $request->descripcion,
            'edad_minima' => $request->edad_minima,
            'edad_maxima' => $request->edad_maxima,
        ]);

        return redirect()->route('categorias.index');
    }

    public function destroy($id)
    {
        DB::table('categorias')->where('id_categoria', $id)->delete();
        return redirect()->route('categorias.index');
    }
}
