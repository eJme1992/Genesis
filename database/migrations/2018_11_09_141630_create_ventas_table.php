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
            $table->string('num_pedido')->nullable(); //numero de documento fisico
            $table->integer('user_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->integer('direccion_id')->unsigned();
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
