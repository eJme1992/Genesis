<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_pedido')->nullable();
            $table->unsignedInteger('motivo_nota_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('cliente_id')->nullable();
            $table->unsignedInteger('direccion_id')->nullable();
            $table->decimal('total', 12, 2)->nullable(); 

            $table->foreign('motivo_nota_id')->references('id')
                                        ->on('motivo_guias')
                                        ->onDelete('cascade');

            $table->foreign('user_id')->references('id')
                                        ->on('users')
                                        ->onDelete('cascade');

            $table->foreign('cliente_id')->references('id')
                                        ->on('clientes')
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
        Schema::dropIfExists('nota_pedidos');
    }
}
