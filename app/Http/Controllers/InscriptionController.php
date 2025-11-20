<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Torneo;
use App\Models\Usuario;
use Illuminate\Http\Request;

class InscriptionController extends Controller
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

    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'id_torneo' => 'required|exists:torneos,id_torneo',
            'fecha_inscripcion' => 'required|date',
            'estado' => 'required|string|in:Inscrito,Participando,Finalizado,Retirado',
            'observaciones' => 'nullable|string|max:500'
        ]);

        try {
            $inscripcionExistente = Inscripcion::where('id_usuario', $request->id_usuario)
                ->where('id_torneo', $request->id_torneo)
                ->exists();

            if ($inscripcionExistente) {
                return redirect()->back()->with('error', 'Este usuario ya está inscrito en el torneo seleccionado.');
            }

            Inscripcion::create($request->all());
            return redirect()->route('inscripciones.index')->with('success', 'Inscripción creada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear la inscripción: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_inscripcion' => 'required|date',
            'estado' => 'required|string|in:Inscrito,Participando,Finalizado,Retirado',
            'observaciones' => 'nullable|string|max:500'
        ]);

        try {
            $inscripcion = Inscripcion::findOrFail($id);
            $inscripcion->update($request->all());
            
            return redirect()->route('inscripciones.index')->with('success', 'Inscripción actualizada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar la inscripción: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $inscripcion = Inscripcion::findOrFail($id);
            $inscripcion->delete();
            
            return redirect()->route('inscripciones.index')->with('success', 'Inscripción eliminada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la inscripción: ' . $e->getMessage());
        }
    }
}