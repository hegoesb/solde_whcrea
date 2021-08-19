<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DossierEtapeChantiersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('dossier_etape_chantiers')->delete();

        \DB::table('dossier_etape_chantiers')->insert(array (
            0 =>
            array (
                'etape_chantier_id' => 1,
                'dossier_id' => 1,
                'created_at' => '2021-01-03 00:00:00',
                'updated_at' => '2021-01-03 00:00:00',
            ),
            1 =>
            array (
                'etape_chantier_id' => 2,
                'dossier_id' => 2,
                'created_at' => '2021-01-03 00:00:00',
                'updated_at' => '2021-01-03 00:00:00',
            ),
            2 =>
            array (
                'etape_chantier_id' => 3,
                'dossier_id' => 2,
                'created_at' => '2021-01-03 00:00:00',
                'updated_at' => '2021-01-03 00:00:00',
            ),
            3 =>
            array (
                'etape_chantier_id' => 4,
                'dossier_id' => 2,
                'created_at' => '2021-01-03 00:00:00',
                'updated_at' => '2021-01-03 00:00:00',
            ),
            4 =>
            array (
                'etape_chantier_id' => 6,
                'dossier_id' => 2,
                'created_at' => '2021-01-03 00:00:00',
                'updated_at' => '2021-01-03 00:00:00',
            ),
            5 =>
            array (
                'etape_chantier_id' => 5,
                'dossier_id' => 3,
                'created_at' => '2021-01-03 00:00:00',
                'updated_at' => '2021-01-03 00:00:00',
            ),
            6 =>
            array (
                'etape_chantier_id' => 7,
                'dossier_id' => 4,
                'created_at' => '2021-01-03 00:00:00',
                'updated_at' => '2021-01-03 00:00:00',
            ),
            7 =>
            array (
                'etape_chantier_id' => 3,
                'dossier_id' => 5,
                'created_at' => '2021-01-03 00:00:00',
                'updated_at' => '2021-01-03 00:00:00',
            ),
            8 =>
            array (
                'etape_chantier_id' => 4,
                'dossier_id' => 5,
                'created_at' => '2021-01-03 00:00:00',
                'updated_at' => '2021-01-03 00:00:00',
            ),
            9 =>
            array (
                'etape_chantier_id' => 6,
                'dossier_id' => 5,
                'created_at' => '2021-01-03 00:00:00',
                'updated_at' => '2021-01-03 00:00:00',
            ),
        ));


    }
}
