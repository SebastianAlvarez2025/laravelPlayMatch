<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion; // El modelo sigue en español
use App\Models\Torneo;
use App\Models\Usuario;
use Illuminate\Http\Request;

class InscriptionController extends Controller // Cambiado a inglés
{
    public function index()
    {
        $search = request('search');
        
        $inscripciones = Inscripcion::with(['torneo', 'usuario'])
            ->when($search, function($query, $search) {
                return $query->whereHas('usuario', function($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%")
                      ->orWhere('apellido', 'like', "%{$search}%");
                })->orWhereHas('torneo', function($q) use ($search) {
                    $q->where('nombre_torneo', 'like', "%{$search}%");
                })->orWhere('estado', 'like', "%{$search}%");
            })
            ->orderBy('fecha_inscripcion', 'desc')
            ->paginate(10);

        $torneos = Torneo::where('estado', 'planificado')->orWhere('estado', 'en_curso')->get();
        $usuarios = Usuario::where('estado', 'activo')->get();

        return view('inscripciones.index', compact('inscripciones', 'torneos', 'usuarios'));
    }

    // ... resto de los métodos
}