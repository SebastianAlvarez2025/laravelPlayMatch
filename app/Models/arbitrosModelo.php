<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arbitro extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla
    protected $table = 'arbitros';

    // Llave primaria
    protected $primaryKey = 'id_arbitro';

    // Si tu ID no es auto-incremental
    public $incrementing = false;

    // Si no tienes created_at / updated_at
    public $timestamps = false;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'id_arbitro',
        'id_usuario',
        'licencia',
        'anos_experiencia',
        'categoria_arbitral'
    ];
}
