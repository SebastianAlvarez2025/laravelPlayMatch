<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Premiacion extends Model
{
    protected $table = 'premiacion';
    protected $primaryKey = 'id_premiacion';
    public $timestamps = false;

    protected $fillable = [
        'id_premiacion',
        'id_torneo',
        'id_equipo',
        'posicion',
        'premio',
        'descripcion',
    ];
}
