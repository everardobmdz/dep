<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea_investigacion extends Model
{
    use HasFactory;

    protected $table = 'lineas_investigacion';
    protected $guarded = ['id', 'activo', 'created_at', 'updated_at'];

    public function investigadores() {
        return $this->belongsToMany(Investigador::class);
    }
}
