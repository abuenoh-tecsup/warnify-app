<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autoridad extends Model
{
    protected $table = 'autoridad';
    protected $primaryKey = 'id_autoridad';
    public $timestamps = true;

    protected $fillable = [
        'cargo',
        'tipo_autoridad',
        'id_usuario',  // Referencia al usuario
    ];

    // Relación con el usuario (uno a uno)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
