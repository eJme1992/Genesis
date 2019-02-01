<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
	        array(
	        	'name' => 'Admin',
	        	'ape' => 'Unico',
	        	'documento' => 'PASAPORTE',
	        	'identificacion' => '12345678',
	        	'ruc' => '12345678',
	        	'sexo' => 'Masculino',
	        	'departamento_id' => '1',
	        	'provincia_id' => '1',
	        	'distrito_id' => '1',
	        	'direccion_hab' => 'casa nº12345678, edif. principal',
	        	'correo' => 'admin@admin.com',
	        	'telefono_casa' => '123456789',
	        	'cargo' => 'Administrador de Distribuidora Genesis',
	        	'usuario'     => 'admin',
		        'rol_id'     => '1',
		        'password'  => bcrypt('admin'),
		        'clave'  => 'admin',
		        'status'  => 'activo'
	        )
	    );

      \DB::table('users')->insert($users);
    }
}
