<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialEstado extends Model
{
    protected $table = 'historial_estado';
    protected $primaryKey = 'id_historial';

    protected $fillable = [
        'id_reporte',
        'estado',
        'fecha_cambio',
    ];

    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'id_reporte');
    }
}
