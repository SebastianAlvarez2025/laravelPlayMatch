<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    protected $table = 'fechas';
    protected $primaryKey = 'id_fecha';
    public $timestamps = false;

    protected $fillable = [
        'id_torneo',
        'numero_fecha',
        'fecha',
        'estado'
    ];

 
    public function encuentros()
    {
        return $this->hasMany(Encuentro::class, 'id_fecha', 'id_fecha');
    }
}
