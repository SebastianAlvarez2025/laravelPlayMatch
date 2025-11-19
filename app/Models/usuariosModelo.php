<?php

namespace App\Models;

use Illuminate\Database\Eloquent\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuariosModelo extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable=[
        'id_usuario',
        'nombre',
        'apellido',
        'correo',
        "telefono",
        "id_rol",
        "fecha_registro",
        "fecha_nacimiento",
        "estado"
    ];
}
