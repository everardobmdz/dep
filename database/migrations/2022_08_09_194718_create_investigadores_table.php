<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestigadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investigadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',45);
            $table->string('apellidos',45);
            $table->string('grado_academico',20);
            $table->string('especialidad',100);
            $table->string('correo');
            $table->text('descripciones');
            $table->text('biografia');
            $table->string('imagen_path')->default('default.png');
            $table->string('region',60);
            $table->string('texto_vista_previa',200);
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investigadores');
    }
}
