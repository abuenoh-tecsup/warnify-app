<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentario';
    protected $primaryKey = 'id_comentario';
    public $timestamps = true;

    protected $fillable = [
        'id_ciudadano',
        'contenido',
    ];

    /**
     * Relación con el ciudadano (usuario)
     * Un comentario pertenece a un ciudadano
     */
    public function ciudadano()
    {
        return $this->belongsTo(Usuario::class, 'id_ciudadano');
    }
}
