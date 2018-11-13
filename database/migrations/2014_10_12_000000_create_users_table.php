<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('ape');
            $table->string('documento')->nullable();
            $table->string('identificacion')->nullable();
            $table->string('ruc')->nullable();
            $table->string('sexo')->nullable();
            $table->integer('departamento_id')->unsigned()->nullable();
            $table->integer('provincia_id')->unsigned()->nullable();
            $table->integer('distrito_id')->unsigned()->nullable();
            $table->string('direccion_hab')->nullable();
            $table->text('direccion')->nullable();
            $table->string('correo')->nullable();
            $table->string('telefono_casa')->nullable();
            $table->string('telefono_movil')->nullable();
            $table->string('foto')->nullable();
            $table->text('cargo')->nullable();
            $table->string('usuario')->unique();
            $table->string('password');
            $table->string('clave')->nullable();
            $table->integer('rol_id')->unsigned()->default(2);
            $table->string('status')->nullable()->default("activo");

            $table->foreign('rol_id')->references('id')
                                       ->on('roles')
                                       ->onDelete('cascade');

            $table->foreign('departamento_id')->references('id')
                                       ->on('ubdepartamento')
                                       ->onDelete('cascade');

            $table->foreign('provincia_id')->references('id')
                                       ->on('ubprovincia')
                                       ->onDelete('cascade');

            $table->foreign('distrito_id')->references('id')
                                       ->on('ubdistrito')
                                       ->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
