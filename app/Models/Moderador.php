<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moderador extends Model
{
    protected $table = 'moderador';
    protected $primaryKey = 'id_moderador';
    public $timestamps = true;

    protected $fillable = [
        'area_supervision',
        'id_usuario',  // Referencia al usuario
    ];

    // Relación con el usuario (uno a uno)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
