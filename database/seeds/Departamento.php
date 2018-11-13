<?php

use Illuminate\Database\Seeder;

class Departamento extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $ubdepartamento = array(
                        array('id' => '1','departamento' => 'AMAZONAS','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '2','departamento' => 'ANCASH','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '3','departamento' => 'APURIMAC','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '4','departamento' => 'AREQUIPA','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '5','departamento' => 'AYACUCHO','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '6','departamento' => 'CAJAMARCA','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '7','departamento' => 'CALLAO','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '8','departamento' => 'CUSCO','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '9','departamento' => 'HUANCAVELICA','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '10','departamento' => 'HUANUCO','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '11','departamento' => 'ICA','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '12','departamento' => 'JUNIN','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '13','departamento' => 'LA LIBERTAD','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '14','departamento' => 'LAMBAYEQUE','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '15','departamento' => 'LIMA','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '16','departamento' => 'LORETO','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '17','departamento' => 'MADRE DE DIOS','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '18','departamento' => 'MOQUEGUA','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '19','departamento' => 'PASCO','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '20','departamento' => 'PIURA','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '21','departamento' => 'PUNO','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '22','departamento' => 'SAN MARTIN','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '23','departamento' => 'TACNA','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '24','departamento' => 'TUMBES','created_at' => NULL,'updated_at' => NULL),
                        array('id' => '25','departamento' => 'UCAYALI','created_at' => NULL,'updated_at' => NULL)
                        );
        \DB::table('ubdepartamento')->insert($ubdepartamento);
    }
}
