<?php

use Illuminate\Database\Seeder;

class BancoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banco = array(
	        array('nombre' => 'BCP'),
	        array('nombre' => 'SCOTIABANK')
	    );
      	
      	//insert manual a una base de datos con array
      	\DB::table('bancos')->insert($banco);
    }
}
