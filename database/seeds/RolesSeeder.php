<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
	        array('id' => '1','name' => 'Admin'),
	        array('id' => '2','name' => 'Vendedor'),
	        array('id' => '3','name' => 'Permiso especial')
	    );
      //insert manual a una base de datos con array
      \DB::table('roles')->insert($roles);
    }
}
