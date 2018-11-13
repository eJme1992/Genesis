<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('motivo_viaje_id')->unsigned()->nullable();
            $table->integer('direccion_id')->unsigned()->nullable();
            $table->string('fecha')->nullable();

            $table->foreign('motivo_viaje_id')->references('id')
                                       ->on('motivo_viajes')
                                       ->onDelete('cascade');

            $table->foreign('direccion_id')->references('id')
                                        ->on('direcciones')
                                        ->onDelete('cascade');
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
        Schema::dropIfExists('rutas');
    }
}
