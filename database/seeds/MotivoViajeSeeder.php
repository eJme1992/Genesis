<?php

use Illuminate\Database\Seeder;

class MotivoViajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = array(
	        array('id' => '1','nombre' => 'SALIDA'),
	        array('id' => '2','nombre' => 'TRASLADO'),
	        array('id' => '3','nombre' => 'LLEGADA')
	    );
      //insert manual a una base de datos con array
      \DB::table('motivo_viajes')->insert($status);
    }
}
