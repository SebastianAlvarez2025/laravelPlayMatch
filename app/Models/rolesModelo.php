<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rolesModelo extends Model
{
    use HasFactory;
    protected $table = 'roles';

    protected $fillable=[
        'id_rol',
        'nombrerol',
        'descripcion'
    ];
}

