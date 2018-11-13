<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuiaRemisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guia_remision', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial')->nullable();
            $table->integer('motivo_guia_id')->unsigned();
            $table->integer('direccion_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('cliente_id')->unsigned()->nullable();

            $table->foreign('motivo_guia_id')->references('id')
                                        ->on('motivo_guias')
                                        ->onDelete('cascade');

            $table->foreign('direccion_id')->references('id')
                                        ->on('direcciones')
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
        Schema::dropIfExists('guia_remision');
    }
}
