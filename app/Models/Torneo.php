<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    use HasFactory;

    protected $table = 'torneos';
    protected $primaryKey = 'id_torneo';

    protected $fillable = [
        'nombre_torneo',
        'fecha_inicio',
        'fecha_fin',
        'ciudad',
        'id_categoria',
        'id_usuario',
        'estado'
    ];

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'id_torneo', 'id_torneo');
    }
}
