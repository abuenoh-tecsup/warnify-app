<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = true;

    protected $fillable = [
        'nombre_apellido',
        'e_mail',
        'telefono',
        'direccion',
        'fecha_registro',
        'notifi_acti',
        'id_distrito',
    ];

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_usuario');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_usuario');
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'id_distrito');
    }
}
