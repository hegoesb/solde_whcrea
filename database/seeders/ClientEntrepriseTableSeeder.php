<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClientEntrepriseTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('client_entreprise')->delete();
        
        \DB::table('client_entreprise')->insert(array (
            0 => 
            array (
                'client_id' => 1,
                'entreprise_id' => 1,
                'created_at' => '2020-12-11 23:00:00',
                'updated_at' => '2020-12-11 23:00:00',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'client_id' => 2,
                'entreprise_id' => 1,
                'created_at' => '2020-12-11 23:00:00',
                'updated_at' => '2020-12-11 23:00:00',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'client_id' => 3,
                'entreprise_id' => 1,
                'created_at' => '2020-12-11 23:00:00',
                'updated_at' => '2020-12-11 23:00:00',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'client_id' => 4,
                'entreprise_id' => 1,
                'created_at' => '2020-12-11 23:00:00',
                'updated_at' => '2020-12-11 23:00:00',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'client_id' => 5,
                'entreprise_id' => 1,
                'created_at' => '2020-12-11 23:00:00',
                'updated_at' => '2020-12-11 23:00:00',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'client_id' => 6,
                'entreprise_id' => 1,
                'created_at' => '2020-12-11 23:00:00',
                'updated_at' => '2020-12-11 23:00:00',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'client_id' => 7,
                'entreprise_id' => 1,
                'created_at' => '2020-12-11 23:00:00',
                'updated_at' => '2020-12-11 23:00:00',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'client_id' => 8,
                'entreprise_id' => 1,
                'created_at' => '2020-12-11 23:00:00',
                'updated_at' => '2020-12-11 23:00:00',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'client_id' => 9,
                'entreprise_id' => 1,
                'created_at' => '2020-12-11 23:00:00',
                'updated_at' => '2020-12-11 23:00:00',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'client_id' => 10,
                'entreprise_id' => 1,
                'created_at' => '2020-12-11 23:00:00',
                'updated_at' => '2020-12-11 23:00:00',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'client_id' => 11,
                'entreprise_id' => 1,
                'created_at' => '2020-12-11 23:00:00',
                'updated_at' => '2020-12-11 23:00:00',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}