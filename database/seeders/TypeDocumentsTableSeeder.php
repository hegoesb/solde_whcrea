<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TypeDocumentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('type_documents')->delete();
        \DB::table('type_documents')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nom' => 'DE',
                'nom_display' => 'Devis',
                'created_at' => '2021-02-06 00:00:00',
                'updated_at' => '2021-02-06 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'nom' => 'FA',
                'nom_display' => 'Facture',
                'created_at' => '2021-02-06 00:00:00',
                'updated_at' => '2021-02-06 00:00:00',
            ),
            2 =>
            array (
                'id' => 3,
                'nom' => 'CT',
                'nom_display' => 'Contrat',
                'created_at' => '2021-02-06 00:00:00',
                'updated_at' => '2021-02-06 00:00:00',
            ),
            3 =>
            array (
                'id' => 4,
                'nom' => 'ST',
                'nom_display' => 'Situation',
                'created_at' => '2021-02-06 00:00:00',
                'updated_at' => '2021-02-06 00:00:00',
            ),

        ));


    }
}
