<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuentro extends Model
{
    use HasFactory;

    protected $table = 'encuentros';      // Nombre de la tabla
    protected $primaryKey = 'id_encuentro'; // Llave primaria
    public $timestamps = false;           // No hay created_at ni updated_at

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'id_fecha',
        'fecha',
        'hora',
        'id_torneo',
        'id_lugar',
        'id_equipo',
        'id_arbitro_principal',
    ];

    // Relaciones con otras tablas
    public function torneo()
    {
        return $this->belongsTo(Torneo::class, 'id_torneo');
    }

    public function lugar()
    {
        return $this->belongsTo(Lugar::class, 'id_lugar');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo');
    }

    public function arbitro()
    {
        return $this->belongsTo(Arbitro::class, 'id_arbitro_principal');
    }
}
