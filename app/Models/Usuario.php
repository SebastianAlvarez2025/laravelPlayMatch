<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'id_usuario',
        'nombre',
        'apellido',
        'correo',
        'telefono',
        'id_rol',
        'fecha_registro',
        'fecha_nacimiento',
        'estado'
    ];

    protected $casts = [
        'fecha_registro' => 'date',
        'fecha_nacimiento' => 'date',
    ];

    // Relación con Rol (si existe el modelo Rol)
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    // Relación con Inscripciones
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'id_usuario', 'id_usuario');
    }

    // Relación con Torneos (como organizador/creador)
    public function torneosCreados()
    {
        return $this->hasMany(Torneo::class, 'id_usuario', 'id_usuario');
    }

    // Scope para usuarios activos
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    // Scope para buscar por nombre o apellido
    public function scopeBuscar($query, $search)
    {
        return $query->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellido', 'like', "%{$search}%");
    }

    // Accessor para nombre completo
    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }
}