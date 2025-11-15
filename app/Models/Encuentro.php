<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuentro extends Model
{
    use HasFactory;

    protected $table = 'encuentros';
    protected $primaryKey = 'id_encuentro';
    public $timestamps = false;

    protected $fillable = [
        'id_fecha',
        'fecha',
        'hora',
        'id_torneo',
        'id_lugar',
        'id_equipo',
        'id_arbitro'
    ];
}
