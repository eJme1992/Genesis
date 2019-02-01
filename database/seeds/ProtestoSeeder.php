<?php

use Illuminate\Database\Seeder;

class ProtestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p = array(
	        array('monto' => '00,00'),
	        array('monto' => '85,00')
	    );
      	
      	//insert manual a una base de datos con array
      	\DB::table('protestos')->insert($p);
    }
}
