<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositoBancariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depositos_bancarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_deposito')->nullable();
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
        Schema::dropIfExists('depositos_bancarios');
    }
}
