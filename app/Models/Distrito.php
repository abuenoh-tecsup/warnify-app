<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $table = 'distrito';
    protected $primaryKey = 'id_distrito';
    public $timestamps = true;

    protected $fillable = ['nom_distrito'];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'id_distrito');
    }

    public function autoridades()
    {
        return $this->hasMany(Autoridad::class, 'id_distrito');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_distrito');
    }
}
