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
        $this->call(UserTableSeeder::class);
    }
}
