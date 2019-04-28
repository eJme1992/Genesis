<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovDevolucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mov_devoluciones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('devolucion_id')->nullable();
            $table->unsignedInteger('notacredito_id')->nullable();
            $table->unsignedInteger('modelo_id')->nullable();
            $table->unsignedInteger('monturas')->nullable();
            $table->unsignedInteger('estuches')->nullable();

            $table->foreign('devolucion_id')->references('id')
                                        ->on('devoluciones')
                                        ->onDelete('cascade');

            $table->foreign('notacredito_id')->references('id')
                                        ->on('nota_creditos')
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
        Schema::dropIfExists('mov_devoluciones');
    }
}
