<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autoridad extends Model
{
    protected $table = 'autoridad';

    protected $primaryKey = 'id_autoridad';

    protected $fillable = [
        'nombre_apellido',
        'cargo',
        'e_mail',
        'telefono',
        'id_distrito',
        'fecha_regis',
        'tipo_autoridad',
    ];

    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'id_distrito');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_autoridad');
    }
}
