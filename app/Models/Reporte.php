<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reporte';
    protected $primaryKey = 'id_reporte';
    public $timestamps = true;

    protected $fillable = [
        'id_ciudadano',
        'titulo',
        'descripcion',
        'ubicacion',
        'estado_reporte',
        'fecha_reporte',
        'fecha_act',
        'id_autoridad',
        'latitud',
        'longitud',
        'img_incidente',
    ];

    /**
     * Relación con el ciudadano (usuario)
     * Un reporte pertenece a un ciudadano
     */
    public function ciudadano()
    {
        return $this->belongsTo(Usuario::class, 'id_ciudadano');
    }

    /**
     * Relación con la autoridad (usuario)
     * Un reporte puede tener una autoridad asociada
     */
    public function autoridad()
    {
        return $this->belongsTo(Usuario::class, 'id_autoridad');
    }
}
