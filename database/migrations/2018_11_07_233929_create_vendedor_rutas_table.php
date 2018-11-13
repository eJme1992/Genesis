<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendedorRutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendedor_rutas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ruta_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('fecha')->nullable();

            $table->foreign('ruta_id')->references('id')
                                        ->on('rutas')
                                        ->onDelete('cascade');

            $table->foreign('user_id')->references('id')
                                        ->on('users')
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
        Schema::dropIfExists('vendedor_rutas');
    }
}
