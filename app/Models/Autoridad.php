<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autoridad extends Model
{
    protected $table = 'autoridad';
    protected $primaryKey = 'id_autoridad';
    public $timestamps = true;

    protected $fillable = [
        'nombre_apellido',
        'cargo',
        'email',
        'telefono',
        'fecha_registro',
        'tipo_autoridad',
    ];

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_autoridad');
    }
}
