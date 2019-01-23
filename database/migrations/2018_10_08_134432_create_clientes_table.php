<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identificacion')->nullable();
            $table->string('tipo_id')->nullable();
            $table->string('nombre_1')->nullable();
            $table->string('nombre_2')->nullable();
            $table->string('ape_1')->nullable();
            $table->string('ape_2')->nullable();
            $table->string('nombre_full')->nullable();
            $table->string('direccion')->nullable();
            $table->string('correo')->nullable();
            $table->string('telefono_1')->nullable();
            $table->string('telefono_2')->nullable();
            $table->integer('status')->unsigned()->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
