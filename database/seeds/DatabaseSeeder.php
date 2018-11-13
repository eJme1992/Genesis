<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Departamento::class);
        $this->call(Provincia::class);
        $this->call(Distrito::class);
        $this->call(RolesSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(StatusAdicionalVentas::class);
        $this->call(MotivoGuiaSeeder::class);
        $this->call(MotivoViajeSeeder::class);

        // usuario de prueba
        App\User::create([
          'name'   => 'Admin',
          'ape'   => 'Admin',
          'documento'   => 'PASAPORTE',
          'identificacion'   => '12345678',
          'ruc'   => '12345678',
          'sexo'   => 'Masculino',
          'departamento_id'   => '1',
          'provincia_id'   => '1',
          'distrito_id'   => '1',
          'direccion_hab'   => 'direccion de prueba',
          'correo'   => 'admin@admin.com',
          'telefono_casa'   => '123456789',
          'cargo'   => 'Administrador de Distribuidora Genesis',
          'usuario'     => 'admin',
          'rol_id'     => 1,
          'password'  => bcrypt('admin'),
          'clave'  => 'admin',
          'status'  => 'activo'
        ]);

    }
}
