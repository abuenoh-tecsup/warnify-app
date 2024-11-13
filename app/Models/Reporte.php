<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
