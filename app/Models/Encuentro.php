<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\fechasModelo;
use App\Models\Torneo;
use App\Models\lugaresModelo;
use App\Models\arbitrosModelo;
use App\Models\Equipo;

class Encuentro extends Model
{
    protected $table = 'encuentros';
    protected $primaryKey = 'id_encuentro';
    public $timestamps = false;

    protected $fillable = [
        'id_fecha',
        'hora',
        'id_torneo',
        'id_lugar',
        'id_arbitro',
        'id_equipo_local',
        'id_equipo_visitante',
        'estado'
    ];

    // FECHA
    public function fecha()
    {
        return $this->belongsTo(fechasModelo::class, 'id_fecha', 'id_fecha');
    }

    // TORNEO
    public function torneo()
    {
        return $this->belongsTo(Torneo::class, 'id_torneo', 'id_torneo');
    }

    // LUGAR
    public function lugar()
    {
        return $this->belongsTo(lugaresModelo::class, 'id_lugar', 'id_lugar');
    }

    // ÁRBITRO
    public function arbitro()
    {
        return $this->belongsTo(arbitrosModelo::class, 'id_arbitro', 'id_arbitro');
    }

    // EQUIPO LOCAL
    public function equipoLocal()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo_local', 'id_equipo');
    }

    // EQUIPO VISITANTE
    public function equipoVisitante()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo_visitante', 'id_equipo');
    }
}
