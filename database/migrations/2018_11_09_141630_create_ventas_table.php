<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        // venta o nota de pedido
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('cliente_id')->nullable();
            $table->unsignedInteger('direccion_id')->nullable();
            $table->decimal('total', 12, 2)->nullable();// monto total de venta
            $table->string('fecha')->nullable(); //fecha del registro del pedido

            $table->foreign('user_id')->references('id')
                                        ->on('users')
                                        ->onDelete('cascade');

            $table->foreign('cliente_id')->references('id')
                                        ->on('clientes')
                                        ->onDelete('cascade');

            $table->foreign('direccion_id')->references('id')
                                        ->on('direcciones')
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
        Schema::dropIfExists('ventas');
    }
}
