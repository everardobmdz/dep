<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Publicacion extends Model
{
    protected $table = 'publicaciones';
    protected $guarded = ['id','created_at','updated_at','activo'];
    use HasFactory;
    use Searchable;

    public function archivos() {
        return $this->hasMany(Publicacion_Archivo::class);
    }

    public function investigadores() {
        return $this->belongsToMany(Investigador::class);
    }

    public function toSearchableArray()
    {
        return [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
        ];
    }
}
