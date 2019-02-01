<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferenciaBancariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferencias_bancarias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_transferencia')->nullable();
            $table->string('monto')->nullable();
            $table->string('fecha')->nullable();
            $table->integer('pago_id')->unsigned()->nullable();  
            $table->integer('banco_id')->unsigned()->nullable();

            $table->foreign('pago_id')->references('id')
                                        ->on('pagos')
                                        ->onDelete('cascade');

            $table->foreign('banco_id')->references('id')
                                        ->on('bancos')
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
        Schema::dropIfExists('transferencias_bancarias');
    }
}
