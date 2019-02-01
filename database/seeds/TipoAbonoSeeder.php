<?php

use Illuminate\Database\Seeder;

class TipoAbonoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo_abono = array(
	        array('nombre' => 'LETRA'),
	        array('nombre' => 'CHEQUE'),
	        array('nombre' => 'TDD'),
	        array('nombre' => 'TDC'),
	        array('nombre' => 'TRANSFERENCIA'),
	        array('nombre' => 'EFECTIVO'),
	        array('nombre' => 'DEPOSITO'),
	    );
      	
      	//insert manual a una base de datos con array
      	\DB::table('tipo_abonos')->insert($tipo_abono);
    }
}
