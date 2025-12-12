<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posicion extends Model
{
    use HasFactory;

    protected $table = 'posiciones';
    protected $primaryKey = 'id_posicion';
    public $timestamps = false;

    protected $fillable = [
        'id_posicion',
        'nombre_torneo',
        'nombre_equipo',
        'pj',
        'pg',
        'pe',
        'pp',
        'gf',
        'gc',
        'gd',
        'puntos'
    ];
}
