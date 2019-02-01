<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLetrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pago_id')->unsigned()->nullable(); //cuando la letra es pagada
            $table->string('numero_u')->nullable(); //numero unico
            $table->string('monto_inicial')->nullable(); //monto antes del protesto
            $table->string('monto_final')->nullable(); //monto despues del protesto, Si la letra no es protestada el monto final es igual al monto inicial
            $table->string('fecha_inicial')->nullable(); //fecha para su cancelacion
            $table->string('fecha_final')->nullable(); //fecha luego de la prórroga del banco - FechaInicial + 7 dias
            $table->string('fecha_pago')->nullable(); //fecha en la que se cancela la letra
            $table->integer('status_id')->unsigned()->nullable();
            $table->integer('protesto_id')->unsigned()->nullable();
            $table->string('no_adeudado')->nullable(); //(1, 0) indica si se generó la carta de no adeudo

            $table->foreign('status_id')->references('id')
                                        ->on('status_letras')
                                        ->onDelete('cascade');

            $table->foreign('protesto_id')->references('id')
                                        ->on('protesto_letras')
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
        Schema::dropIfExists('letras');
    }
}
