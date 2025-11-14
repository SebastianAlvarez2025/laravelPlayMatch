<?php

namespace App\Models;

use Illuminate\Database\Eloquent\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jugadoresModelo extends Model
{
    protected $table = 'jugadores';
    protected $primaryKey = 'id_jugador';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable=[
        'id_jugador',
        'id_usuario',
        'id_equipo',
        'posicion',
        "numero_camiseta",
        "estado"
    ];
}
