<?php

namespace App\Models;

use Illuminate\Database\Eloquent\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugaresModelo extends Model
{
    
    protected $table = 'lugares';
    protected $primaryKey = 'id_lugar';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable=[
        'id_lugar',
        'nombre_lugar',
        'direccion',
        'ciudad',
        "capacidad"
    ];

}
