<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleGuiaRemisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_guia_remision', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('guia_remision_id');
            $table->unsignedInteger('ref_item_id');
            $table->decimal('cantidad', 12, 2)->nullable();
            $table->decimal('peso', 12, 2)->nullable(); /// peso en kg
            $table->text('descripcion')->nullable(); // descripcion de la mercancia
            $table->string('status')->nullable(); // descripcion de la mercancia

            $table->foreign('guia_remision_id')->references('id')
                                        ->on('guia_remision')
                                        ->onDelete('cascade');
                                        
            $table->foreign('ref_item_id')->references('id')
                                        ->on('ref_item')
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
        Schema::dropIfExists('detalle_guia_remision');
    }
}
