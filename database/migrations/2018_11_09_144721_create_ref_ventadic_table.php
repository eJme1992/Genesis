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
            $table->unsignedInteger('venta_id')->nullable();
            $table->unsignedInteger('factura_id')->nullable();
            $table->unsignedInteger('ref_item_id')->nullable(); // fk de la tabla ref_item
            $table->unsignedInteger('ref_estadic_id')->nullable(); // llave que referencia a la tabla "estado de entrega"
            $table->string('fecha_estado')->nullable(); // fecha en la que cambia el estado

            $table->foreign('ref_item_id')->references('id')
                                        ->on('ref_item')
                                        ->onDelete('cascade');
            
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
