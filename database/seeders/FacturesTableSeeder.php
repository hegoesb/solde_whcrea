<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacturesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('factures')->delete();
        
        \DB::table('factures')->insert(array (
            0 => 
            array (
                'id' => 2,
                'numero' => 'EBX_FA2012-0010',
                'chantier_id' => 1,
                'client_id' => 10,
                'bilan_id' => NULL,
                'entreprise_id' => 1,
                'type_facture_id' => 3,
                'total_ht' => 336.5,
                'total_ttc' => 403.8,
                'tva' => 67.3,
                'collaborateur_id' => 3,
                'retenuegarantie_ht' => NULL,
                'date_creation' => '2020-12-23',
                'date_echeance' => '2020-12-23',
                'date_envoie' => '2020-12-23',
                'date_paye' => NULL,
                'created_at' => '2020-12-23 13:38:47',
                'updated_at' => '2020-12-23 13:39:05',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}