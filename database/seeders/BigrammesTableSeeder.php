<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BigrammesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bigrammes')->delete();
        
        \DB::table('bigrammes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nom' => 'PLD',
            'nom_display' => 'Plan Detaillé (Câblage)',
                'sousdossier_id' => 7,
                'created_at' => '2021-01-05 00:00:00',
                'updated_at' => '2021-01-05 00:00:00',
            ),
            1 => 
            array (
                'id' => 2,
                'nom' => 'PLU',
                'nom_display' => 'Plan Unifilaire',
                'sousdossier_id' => 7,
                'created_at' => '2021-01-05 00:00:00',
                'updated_at' => '2021-01-05 00:00:00',
            ),
            2 => 
            array (
                'id' => 3,
                'nom' => 'PLD',
                'nom_display' => 'Plan d\'implantation',
                'sousdossier_id' => 7,
                'created_at' => '2021-01-05 00:00:00',
                'updated_at' => '2021-01-05 00:00:00',
            ),
            3 => 
            array (
                'id' => 4,
                'nom' => 'PLC',
                'nom_display' => 'Plan du client',
                'sousdossier_id' => 2,
                'created_at' => '2021-01-05 00:00:00',
                'updated_at' => '2021-01-05 00:00:00',
            ),
        ));
        
        
    }
}