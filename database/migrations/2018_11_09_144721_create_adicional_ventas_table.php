<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdicionalVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adicional_ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venta_id')->unsigned();
            $table->integer('factura_id')->unsigned()->nullable();
            $table->string('item')->nullable();
            $table->string('fecha')->nullable(); // fecha en la que cambia el estado
            $table->integer('status_adicional_id')->unsigned();

            $table->foreign('status_adicional_id')->references('id')
                                        ->on('status_adicional_ventas')
                                        ->onDelete('cascade');

            $table->foreign('venta_id')->references('id')
                                        ->on('ventas')
                                        ->onDelete('cascade');

            $table->foreign('factura_id')->references('id')
                                        ->on('facturas')
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
        Schema::dropIfExists('adicional_ventas');
    }
}
