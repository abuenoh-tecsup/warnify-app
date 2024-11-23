<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentario'; // Nombre de la tabla asociada
    protected $primaryKey = 'id_comentario'; // Clave primaria personalizada
    public $timestamps = true; // Uso automático de las columnas created_at y updated_at

    protected $fillable = [
        'id_ciudadano',
        'contenido',
    ];

    /**
     * Relación con la tabla Ciudadano.
     * Un comentario pertenece a un ciudadano.
     */
    public function ciudadano()
    {
        return $this->belongsTo(Ciudadano::class, 'id_ciudadano', 'id_ciudadano');
    }

    /**
     * Accesor para obtener la información de la última edición en formato "hace x tiempo".
     */
    public function getTiempoEditadoAttribute()
    {
        if ($this->created_at != $this->updated_at) {
            return $this->updated_at->diffForHumans();
        }
        return null; // Si no ha sido editado, retorna null
    }
}
