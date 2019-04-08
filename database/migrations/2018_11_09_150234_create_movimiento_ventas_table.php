<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientoVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // En el movimiento de venta se detalla la cantidad y el costo de cada producto
        Schema::create('mov_ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('venta_id')->nullable();
            $table->unsignedInteger('modelo_id')->nullable();
            $table->unsignedInteger('monturas')->nullable();
            $table->unsignedInteger('estuches')->nullable();
            $table->decimal('precio_montura' , 12, 2)->nullable();
            $table->decimal('precio_modelo', 12, 2)->nullable(); // monturas(cajas) + precio monturas = total

            $table->foreign('venta_id')->references('id')
                                        ->on('ventas')
                                        ->onDelete('cascade');

            $table->foreign('modelo_id')->references('id')
                                        ->on('modelos')
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
        Schema::dropIfExists('mov_ventas');
    }
}
