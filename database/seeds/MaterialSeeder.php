<?php

use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $materiales = array(
        array('id' => '1','name' => 'Acetato'),
        array('id' => '2','name' => 'Metalica'),
        array('id' => '3','name' => 'Carey'),
        array('id' => '4','name' => 'Madera'),
        array('id' => '5','name' => 'Plastico'),
      );
      //insert manual a una base de datos con array
      \DB::table('materiales')->insert($materiales);
    }
}
