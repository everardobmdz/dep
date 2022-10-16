<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSobreElDepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sobre_el_dep', function (Blueprint $table) {
            $table->id();
            $table->string('contenido');
            $table->unsignedBigInteger('investigador_id');
            $table->timestamps();

            $table->foreign('investigador_id')->references('id')->on('investigadores');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sobre_el_dep');
    }
}
