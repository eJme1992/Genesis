<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = array(
	        array('id' => '1','name' => 'En Stock'),
	        array('id' => '2','name' => 'Asignado'),
	        array('id' => '3','name' => 'Baja'),
	        array('id' => '4','name' => 'Agotado'),
	        array('id' => '5','name' => 'Fuera de circulacion')
	    );
      //insert manual a una base de datos con array
      \DB::table('status')->insert($status);
    }
}
