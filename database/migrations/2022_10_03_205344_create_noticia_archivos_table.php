<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiaArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticia_archivos', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->foreignId('noticia_id')
            ->nullable()
            ->constrained('noticias')
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
        Schema::dropIfExists('noticia_archivos');
    }
}
