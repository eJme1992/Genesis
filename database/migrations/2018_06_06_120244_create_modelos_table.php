<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('name');
            $table->text('descripcion_modelo')->nullable();
            $table->integer('montura')->unsigned();
            $table->integer('estuche')->unsigned()->nullable();
            $table->decimal('precio_montura', 12,2)->nullable();
            $table->integer('cajas')->nullable();
            $table->integer('coleccion_id')->unsigned();
            $table->foreign('coleccion_id')->references('id')
                                       ->on('colecciones')
                                       ->onDelete('cascade');

            $table->integer('marca_id')->unsigned();
            $table->foreign('marca_id')->references('id')
                                       ->on('marcas')
                                       ->onDelete('cascade');

           $table->integer('status_id')->unsigned();
           $table->foreign('status_id')->references('id')
                                      ->on('status')
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
        Schema::dropIfExists('modelos');
    }
}
