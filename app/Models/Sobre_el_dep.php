<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sobre_el_dep extends Model
{
    use HasFactory;
    protected $table = 'sobre_el_dep';

    public function investigador() {
        return $this->belongsTo(Investigador::class);
    }
}
