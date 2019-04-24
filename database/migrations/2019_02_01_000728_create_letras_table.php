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
            $table->unsignedInteger('pago_id')->nullable(); //cuando la letra es pagada
            $table->unsignedInteger('status_id')->nullable();
            $table->unsignedInteger('protesto_id')->nullable();
            $table->string('numero_unico')->nullable(); //numero unico
            $table->string('monto_inicial')->nullable(); //monto antes del protesto
            $table->string('monto_final')->nullable(); //monto despues del protesto, Si la letra no es protestada el monto final es igual al monto inicial
            $table->string('fecha_inicial')->nullable(); //fecha para su cancelacion
            $table->string('fecha_final')->nullable(); //fecha luego de la prórroga del banco - FechaInicial + 7 dias
            $table->string('fecha_pago')->nullable(); //fecha en la que se cancela la letra
            $table->string('no_adeudado')->nullable(); //(1, 0) indica si se generó la carta de no adeudo

            $table->foreign('pago_id')->references('id')
                                        ->on('pagos')
                                        ->onDelete('cascade');

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
