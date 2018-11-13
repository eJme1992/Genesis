<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('departamento_id')->unsigned()->nullable();
            $table->integer('provincia_id')->unsigned()->nullable();
            $table->integer('distrito_id')->unsigned()->nullable();//opcional
            $table->string('detalle')->nullable();//opcional
            $table->string('tipo')->nullable();
            $table->string('fecha')->nullable();

            $table->foreign('departamento_id')->references('id')
                                       ->on('ubdepartamento')
                                       ->onDelete('cascade');

            $table->foreign('provincia_id')->references('id')
                                       ->on('ubprovincia')
                                       ->onDelete('cascade');

            $table->foreign('distrito_id')->references('id')
                                       ->on('ubdistrito')
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
        Schema::dropIfExists('direcciones');
    }
}
