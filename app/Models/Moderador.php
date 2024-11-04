<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moderador extends Model
{
    protected $table = 'moderador';

    protected $primaryKey = 'id_moderador';

    protected $fillable = [
        'nom_apell',
        'e_mail',
    ];

    public function historialEstados()
    {
        return $this->hasMany(HistorialEstado::class, 'cambiado_por');
    }
}
