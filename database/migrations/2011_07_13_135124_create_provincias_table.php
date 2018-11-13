<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvinciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubprovincia', function (Blueprint $table) {
            $table->increments('id');
            $table->string("provincia");
            $table->integer("departamento_id")->unsigned();

            $table->foreign('departamento_id')->references('id')
                                       ->on('ubdepartamento')
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
        Schema::dropIfExists('ubprovincia');
    }
}
