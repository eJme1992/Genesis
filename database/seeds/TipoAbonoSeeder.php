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
	        array('codigo' => 'LTR', 'nombre' => 'LETRA'),
	        array('codigo' => 'CHQ', 'nombre' => 'CHEQUE'),
	        array('codigo' => 'TDD', 'nombre' => 'Tarjeta de Debito'),
	        array('codigo' => 'TDC', 'nombre' => 'Tarjeta de Credito'),
	        array('codigo' => 'TRA', 'nombre' => 'TRANSFERENCIA'),
	        array('codigo' => 'EFE', 'nombre' => 'EFECTIVO'),
	        array('codigo' => 'DEP', 'nombre' => 'DEPOSITO'),
	    );
      	
      	//insert manual a una base de datos con array
      	\DB::table('tipo_abonos')->insert($tipo_abono);
    }
}
