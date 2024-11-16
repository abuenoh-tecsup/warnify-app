<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reporte extends Model
{
    protected $table = 'reporte';
    protected $primaryKey = 'id_reporte';
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
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

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function autoridad()
    {
        return $this->belongsTo(Autoridad::class, 'id_autoridad');
    }

    public function historialEstados()
    {
        return $this->hasMany(HistorialEstado::class, 'id_reporte');
    }

    /**
     * Accessor para formatear la fecha del reporte
     */
    public function getFechaReporteAttribute($value)
    {
        return Carbon::parse($value)->format('M j, Y h:i A');
    }

    /**
     * Accessor para formatear la fecha de actualización
     */
    public function getFechaActAttribute($value)
    {
        return Carbon::parse($value)->format('M j, Y h:i A');
    }
}
