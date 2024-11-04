<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre_apellid',
        'e_mail',
        'telefono',
        'direccion',
        'distrito',
        'fecha_registro',
        'notifi_acti',
        'id_distrit',
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
        return $this->belongsTo(Distrito::class, 'id_distrit');
    }
}
