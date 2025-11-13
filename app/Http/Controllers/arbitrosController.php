<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class arbitrosController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $datos = DB::table('arbitros')
            ->when($search, function ($query, $search) {
                return $query->where('licencia', 'LIKE', "%{$search}%")
                             ->orWhere('categoria_arbitral', 'LIKE', "%{$search}%")
                             ->orWhere('id_usuario', 'LIKE', "%{$search}%");
            })
            ->orderBy('id_arbitro', 'asc')  ->paginate(10);

        return view('arbitros', compact('datos'));
    }

    public function store(Request $request)
    {
        DB::table('arbitros')->insert([
            'id_usuario' => $request->id_usuario,
            'licencia' => $request->licencia,
            'anos_experiencia' => $request->anos_experiencia,
            'categoria_arbitral' => $request->categoria_arbitral,
        ]);

        return redirect()->route('arbitros.index');
    }

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

    public function destroy($id)
    {
        DB::table('arbitros')->where('id_arbitro', $id)->delete();
        return redirect()->route('arbitros.index');
    }
}
