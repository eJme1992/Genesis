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
            $table->unsignedInteger('motivo_guia_id');
            $table->unsignedInteger('dir_salida')->nullable();
            $table->unsignedInteger('dir_llegada')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('cliente_id')->nullable();

            $table->foreign('motivo_guia_id')->references('id')
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
        Schema::dropIfExists('guia_remision');
    }
}
