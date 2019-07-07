<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsignacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consignaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('cliente_id')->nullable();
            $table->unsignedInteger('guia_id')->nullable();
            $table->unsignedInteger('notapedido_id')->nullable();
            $table->unsignedInteger('status')->nullable();
            $table->string('fecha_envio')->nullable();
            $table->decimal('total', 12, 2)->nullable();// monto total de venta

            $table->foreign('user_id')->references('id')
                                        ->on('users')
                                        ->onDelete('cascade');

            $table->foreign('cliente_id')->references('id')
                                        ->on('clientes')
                                        ->onDelete('cascade');

            $table->foreign('guia_id')->references('id')
                                        ->on('guia_remision')
                                        ->onDelete('cascade');

            $table->foreign('notapedido_id')->references('id')
                                        ->on('nota_pedidos')
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
        Schema::dropIfExists('consignaciones');
    }
}
