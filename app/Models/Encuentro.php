<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'id_equipo',
        'id_arbitro'
    ];

    public function torneo() {
        return $this->belongsTo(torneoModel::class, 'id_torneo', 'id_torneo');
    }

    public function lugar() {
        return $this->belongsTo(lugaresModelo::class, 'id_lugar', 'id_lugar');
    }

    public function equipo() {
        return $this->belongsTo(equipo::class, 'id_equipo', 'id_equipo');
    }

    public function arbitro() {
        return $this->belongsTo(arbitrosModelo::class, 'id_arbitro', 'id_arbitro');
    }

    public function fechaInfo() {
        return $this->belongsTo(fechasModelo::class, 'id_fecha', 'id_fecha');
    }
}
