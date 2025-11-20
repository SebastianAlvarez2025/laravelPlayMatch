<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';
    protected $primaryKey = 'id_inscripcion';

    protected $fillable = [
        'id_torneo',
        'id_usuario', 
        'fecha_inscripcion',
        'estado',
        'observaciones'
    ];

    protected $casts = [
        'fecha_inscripcion' => 'date',
    ];

    public function torneo()
    {
        return $this->belongsTo(Torneo::class, 'id_torneo', 'id_torneo');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // Scope para inscripciones activas
    public function scopeActivas($query)
    {
        return $query->where('estado', 'Inscrito')->orWhere('estado', 'Participando');
    }

    // Scope para un torneo específico
    public function scopePorTorneo($query, $torneoId)
    {
        return $query->where('id_torneo', $torneoId);
    }
}