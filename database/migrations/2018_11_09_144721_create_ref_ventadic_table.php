<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefVentadicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabla que detalla el estado de la entrega de la factura,
        //Cuando el estado de la factura cambia a entregado se debe colocar el id de la factura
        Schema::create('ref_ventadic', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venta_id')->unsigned();
            $table->integer('factura_id')->unsigned()->nullable();
            $table->string('item')->nullable(); // F:factura, E:estuche
            $table->string('fecha')->nullable(); // fecha en la que cambia el estado
            $table->integer('ref_estadic_id')->unsigned(); // llave que referencia a la tabla "estado de entrega"

            $table->foreign('ref_estadic_id')->references('id')
                                        ->on('ref_estadic')
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
        Schema::dropIfExists('ref_ventadic');
    }
}
