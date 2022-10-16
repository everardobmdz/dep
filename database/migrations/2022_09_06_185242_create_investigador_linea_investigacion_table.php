<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestigadorLineaInvestigacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investigador_linea_investigacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investigador_id');
            $table->unsignedBigInteger('linea_investigacion_id');

            $table->foreign('investigador_id')->references('id')->on('investigadores')->onDelete('cascade');
            $table->foreign('linea_investigacion_id')->references('id')->on('lineas_investigacion')->onDelete('cascade');

            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investigador_linea_investigacion');
    }
}
