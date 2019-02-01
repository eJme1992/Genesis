<?php

use Illuminate\Database\Seeder;

class StatusAdicionalVentas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = array(
	        array('id' => '1','nombre' => 'Solicitado_Pendiente'),
	        array('id' => '2','nombre' => 'No solicitado'),
	        array('id' => '3','nombre' => 'Entregado')
	    );
      //insert manual a una base de datos con array
      \DB::table('ref_estadic')->insert($status);
    }
}
