<?php

namespace App\Models;

use Illuminate\Database\Eloquent\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fechasModelo extends Model
{
    protected $table = 'fechas';
    protected $primaryKey = 'id_fecha';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable=[
        'id_fecha',
        'id_torneo',
        'numero_fecha',
        'fecha',
        "estado"
    ];
}
