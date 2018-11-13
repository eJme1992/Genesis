<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubdistrito', function (Blueprint $table) {
            $table->increments('id');
            $table->string("distrito");
            $table->integer("provincia_id")->unsigned();

            $table->foreign('provincia_id')->references('id')
                                       ->on('ubprovincia')
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
        Schema::dropIfExists('ubdistrito');
    }
}
