<?php

use Illuminate\Database\Seeder;

class StatusLetraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = array(
	        array('nombre' => 'PENDIENTE'),
	        array('nombre' => 'VENCIDA'),
	        array('nombre' => 'PROTESTO'),
	        array('nombre' => 'CANCELADA')
	    );
      	
      	//insert manual a una base de datos con array
      	\DB::table('status_letras')->insert($status);
    }
}
