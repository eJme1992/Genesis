<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serie')->nullable();//numero de serie
            $table->string('num_fact')->nullable();//numero de factura
            $table->integer('ciente_id')->unsigned();
            $table->decimal('subtotal', 12, 2)->nullable();
            $table->decimal('impuesto', 12, 2)->nullable();
            $table->decimal('total', 12, 2)->nullable();
            $table->string('fecha')->nullable();
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
        Schema::dropIfExists('facturas');
    }
}
