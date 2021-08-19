<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DeviFactureTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('devi_facture')->delete();
        
        \DB::table('devi_facture')->insert(array (
            0 => 
            array (
                'devi_id' => 1,
                'facture_id' => 2,
                'created_at' => '2020-12-23 13:39:05',
                'updated_at' => '2020-12-23 13:39:05',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}