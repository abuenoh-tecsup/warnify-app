<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reporte';
    protected $primaryKey = 'id_reporte';

    protected $fillable = [
        'id_usuario',
        'titulo',
        'descrip',
        'ubicacion',
        'distrito',
        'estado_report',
        'fecha_report',
        'fecha_act',
        'id_autoridad',
        'id_distrit',
        'id_moderador',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function autoridad()
    {
        return $this->belongsTo(Autoridad::class, 'id_autoridad');
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'id_distrit');
    }

    public function moderador()
    {
        return $this->belongsTo(Moderador::class, 'id_moderador');
    }
}
