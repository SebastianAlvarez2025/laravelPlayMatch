<?php

namespace App\Models;

use Illuminate\Database\Eloquent\HasFactory;
use Illuminate\Database\Eloquent\Model;

class torneosModelo extends Model
{
    protected $table = 'torneos';
    protected $primaryKey = 'id_torneo';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable=[
        'id_torneo',
        'nombre_torneo',
        'fecha_inicio',
        'fecha_fin',
        "ciudad",
        "id_categoria",
        "id_usuario",
        "estado"
    ];
}
