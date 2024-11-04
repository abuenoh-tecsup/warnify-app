<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moderador extends Model
{
    protected $table = 'moderador';
    protected $primaryKey = 'id_moder';

    protected $fillable = [
        'nom_apell',
        'e_mail',
    ];

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_moderador');
    }
}
