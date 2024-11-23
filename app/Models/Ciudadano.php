<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudadano extends Model
{
    use HasFactory;

    // Tabla asociada al modelo
    protected $table = 'ciudadano';

    // Clave primaria
    protected $primaryKey = 'id_ciudadano';

    // Si no usas timestamps, puedes desactivar la propiedad
    public $timestamps = true;

    // Campos asignables masivamente
    protected $fillable = [
        'id_usuario',  // ID del usuario, clave foránea que hace referencia a la tabla `usuario`
        'documento_identidad',
        'ocupacion',
    ];

    /**
     * Relación con la tabla Usuario.
     * Un ciudadano pertenece a un usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario'); // Relación con clave foránea
    }

    /**
     * Relación con la tabla Comentario.
     * Un ciudadano puede tener muchos comentarios.
     */
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_ciudadano', 'id_ciudadano');
    }
}
