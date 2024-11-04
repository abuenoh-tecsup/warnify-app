<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialEstado extends Model
{
    protected $table = 'historial_estado';
    protected $primaryKey = 'id_historial';
    public $timestamps = true;

    protected $fillable = [
        'id_reporte',
        'estado_anterior',
        'nuevo_estado',
        'cambiado_por',
    ];

    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'id_reporte');
    }

    public function moderador()
    {
        return $this->belongsTo(Moderador::class, 'cambiado_por');
    }
}
