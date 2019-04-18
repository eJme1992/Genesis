<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $items = array(
          array('nombre' => 'FACTURA'),
          array('nombre' => 'MODELO'),
          array('nombre' => 'ESTUCHE'),
          array('nombre' => 'OTRO'),
      );
      
      //insert manual a una base de datos con array
      \DB::table('ref_item')->insert($items);
    }
}
