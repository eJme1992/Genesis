<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleConsignacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_consignaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('consignacion_id');
            $table->unsignedInteger('modelo_id');
            $table->unsignedInteger('montura');
            $table->unsignedInteger('estuche')->nullable();
            $table->decimal('costo', 12, 2)->nullable();
            $table->string('status')->nullable();

            $table->foreign('consignacion_id')->references('id')
                                        ->on('consignaciones')
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
        Schema::dropIfExists('detalle_consignaciones');
    }
}
