<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    // Tabla y clave primaria
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = true;

    // Campos llenables
    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'telefono',
        'direccion',
        'notifi_acti',
        'password',
        'tipo', // Tipo de usuario (ciudadano, autoridad, moderador)
    ];

    // Relación con los Reportes
    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_usuario');
    }

    // Relación con los Comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_usuario');
    }

    // Relación con el Ciudadano
    public function ciudadano()
    {
        return $this->hasOne(Ciudadano::class, 'id_usuario');
    }

    // Relación con la Autoridad
    public function autoridad()
    {
        return $this->hasOne(Autoridad::class, 'id_usuario');
    }

    // Relación con el Moderador
    public function moderador()
    {
        return $this->hasOne(Moderador::class, 'id_usuario');
    }

    // Método para verificar el tipo de usuario
    public function isCiudadano()
    {
        return $this->tipo === 'ciudadano';
    }

    public function isAutoridad()
    {
        return $this->tipo === 'autoridad';
    }

    public function isModerador()
    {
        return $this->tipo === 'moderador';
    }
}
