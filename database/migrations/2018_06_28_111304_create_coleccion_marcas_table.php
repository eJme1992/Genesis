<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColeccionMarcasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colecciones_marcas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("coleccion_id")->unsigned();
            $table->integer("marca_id")->unsigned();
            $table->string('rueda')->nullable();
            $table->decimal('precio_almacen', 12,2)->nullable();
            $table->decimal('precio_venta_establecido', 12,2)->nullable();

            $table->foreign('coleccion_id')->references('id')
                                       ->on('colecciones')
                                       ->onDelete('cascade');

            $table->foreign('marca_id')->references('id')
                                       ->on('marcas')
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
        Schema::dropIfExists('colecciones_marcas');
    }
}
