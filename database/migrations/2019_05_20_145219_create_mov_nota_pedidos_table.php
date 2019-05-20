<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovNotaPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mov_nota_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('notapedido_id')->nullable();
            $table->unsignedInteger('modelo_id')->nullable();
            $table->unsignedInteger('monturas')->nullable();
            $table->unsignedInteger('estuches')->nullable();

            $table->foreign('notapedido_id')->references('id')
                                        ->on('nota_pedidos')
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
        Schema::dropIfExists('mov_nota_pedidos');
    }
}
