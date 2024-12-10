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
        'cambiado_por_usuario',
        'comentario',
    ];

    /**
     * Relación con el reporte
     * Un historial de estado pertenece a un reporte
     */
    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'id_reporte');
    }

    /**
     * Relación con el usuario que cambió el estado
     * El cambio de estado fue realizado por un usuario (moderador o autoridad)
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'cambiado_por_usuario');
    }
}
