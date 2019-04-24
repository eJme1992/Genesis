<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venta_id')->unsigned()->nullable();//venta relacionada con el pago
            $table->integer('tipo_bono_id')->unsigned()->nullable(); 
            $table->decimal('total', 12, 2)->nullable(); //total de la deuda
            $table->decimal('abono', 12, 2)->nullable(); 
            $table->decimal('restante', 12, 2)->nullable(); 
            $table->string('fecha_cacelacion')->nullable(); //fecha de cacelacion del pago

            $table->foreign('venta_id')->references('id')
                                        ->on('ventas')
                                        ->onDelete('cascade');
                                        
            $table->foreign('tipo_bono_id')->references('id')
                                        ->on('tipo_abonos')
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
        Schema::dropIfExists('pagos');
    }
}
