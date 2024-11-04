<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentario';
    protected $primaryKey = 'id_comentario';
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
        'contenido',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
