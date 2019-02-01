<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheques', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pago_id')->unsigned()->nullable();
            $table->integer('banco_id')->unsigned()->nullable();
            $table->integer('tipo_cheque_id')->unsigned()->nullable();
            $table->string('n_cheque'); //numero de cheque
            $table->string('monto'); //numero de cheque
            $table->string('fecha'); //numero de cheque
            $table->text('comentario'); //numero de cheque

            $table->foreign('pago_id')->references('id')
                                        ->on('pagos')
                                        ->onDelete('cascade');

            $table->foreign('banco_id')->references('id')
                                        ->on('bancos')
                                        ->onDelete('cascade');

            $table->foreign('tipo_cheque_id')->references('id')
                                        ->on('tipo_cheques')
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
        Schema::dropIfExists('cheques');
    }
}
