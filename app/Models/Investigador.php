<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Investigador extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'investigadores';
    protected $guarded = ['id','created_at','updated_at', 'activo'];

    public function proyectos_actuales() {
        return $this->hasMany(Proyecto_actual::class);
    }
    public function sobre_el_dep() {
        return $this->hasOne(Sobre_el_dep::class);
    }
    public function lineas_investigacion() {
        return $this->belongsToMany(Linea_investigacion::class);
    }
    public function publicaciones() {
        return $this->belongsToMany(Publicacion::class);
    }

    public function toSearchableArray()
    {
        return [
            'nombre' => $this->nombre,
            'apellido' => $this->apellidos,
            'grado' => $this->grado_academico,
        ];
    }
}
