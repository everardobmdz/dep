<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacion_archivos', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->foreignId('publicacion_id')
            ->nullable()
            ->constrained('publicaciones')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('publicacion_archivos');
    }
}
