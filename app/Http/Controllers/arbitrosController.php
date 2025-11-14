<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArbitrosController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->get('search');

        $datos = DB::table('arbitros')
            ->when($buscar, function ($query, $buscar) {
                return $query->where('categoria_arbitral', 'LIKE', "%{$buscar}%")
                             ->orWhere('licencia', 'LIKE', "%{$buscar}%");
            })
            ->paginate(10);

        return view('arbitros', compact('datos'));
    }

    // Guarda
    public function store(Request $request)
    {
        DB::table('arbitros')->insert([
            'id_arbitro' => $request->id_arbitro,
            'id_usuario' => $request->id_usuario,
            'licencia' => $request->licencia,
            'anos_experiencia' => $request->anos_experiencia,
            'categoria_arbitral' => $request->categoria_arbitral,
        ]);

        return redirect()->route('arbitros.index');
    }

    // Actualiza
    public function update(Request $request, $id)
    {
        DB::table('arbitros')->where('id_arbitro', $id)->update([
            'id_usuario' => $request->id_usuario,
            'licencia' => $request->licencia,
            'anos_experiencia' => $request->anos_experiencia,
            'categoria_arbitral' => $request->categoria_arbitral,
        ]);

        return redirect()->route('arbitros.index');
    }

    // Elimina
    public function destroy($id)
    {
        DB::table('arbitros')->where('id_arbitro', $id)->delete();
        return redirect()->route('arbitros.index');
    }
}
