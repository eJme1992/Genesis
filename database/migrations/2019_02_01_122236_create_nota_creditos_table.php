<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_creditos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('factura_id')->nullable();
            $table->string('n_serie')->nullable();
            $table->string('n_nota')->nullable();
            $table->decimal('subtotal', 12, 2)->nullable();
            $table->decimal('impuesto', 12, 2)->nullable();
            $table->decimal('total', 12, 2)->nullable(); 

            $table->foreign('factura_id')->references('id')
                                        ->on('facturas')
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
        Schema::dropIfExists('nota_creditos');
    }
}
