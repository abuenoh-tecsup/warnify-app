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

    // Si no usas timestamps, puedes desactivar la propiedad, aunque aquí parece que sí se usarán
    public $timestamps = true;

    // Campos asignables masivamente
    protected $fillable = [
        'id_usuario',  // ID del usuario, clave foránea que hace referencia a la tabla `usuario`
        'documento_identidad',
        'ocupacion',
    ];

    // Relación con la tabla usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
