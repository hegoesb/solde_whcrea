<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DossiersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('dossiers')->delete();

        \DB::table('dossiers')->insert(array (
            0 =>
            array (
                'id' => 1,
                'type' => 'Terrain',
                'famille' => '3',
                'numero' => '311',
                'libelle' => 'Pre-Etudes',
                'created_at' => '2021-01-02 00:00:00',
                'updated_at' => '2021-01-02 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'type' => 'Terrain',
                'famille' => '3',
                'numero' => '312',
                'libelle' => 'Etudes-Chantiers',
                'created_at' => '2021-01-02 00:00:00',
                'updated_at' => '2021-01-02 00:00:00',
            ),
            2 =>
            array (
                'id' => 3,
                'type' => 'Terrain',
                'famille' => '3',
                'numero' => '313',
                'libelle' => 'DOE',
                'created_at' => '2021-01-02 00:00:00',
                'updated_at' => '2021-01-02 00:00:00',
            ),
            3 =>
            array (
                'id' => 4,
                'type' => 'Terrain',
                'famille' => '3',
                'numero' => '314',
                'libelle' => 'Projets_Perdus',
                'created_at' => '2021-01-02 00:00:00',
                'updated_at' => '2021-01-02 00:00:00',
            ),
            4 =>
            array (
                'id' => 5,
                'type' => 'Terrain',
                'famille' => '3',
                'numero' => '331',
                'libelle' => 'Chantiers',
                'created_at' => '2021-01-02 00:00:00',
                'updated_at' => '2021-01-02 00:00:00',
            ),
            5 =>
            array (
                'id' => 6,
                'type' => 'Gestion',
                'famille' => '2',
                'numero' => '220',
                'libelle' => 'Client_Factures',
                'created_at' => '2021-02-08 00:00:00',
                'updated_at' => '2021-02-08 00:00:00',
            ),
            6 =>
            array (
                'id' => 7,
                'type' => 'Gestion',
                'famille' => '2',
                'numero' => '221',
                'libelle' => 'Client_Situations',
                'created_at' => '2021-02-08 00:00:00',
                'updated_at' => '2021-02-08 00:00:00',
            ),
            7 =>
            array (
                'id' => 8,
                'type' => 'Gestion',
                'famille' => '2',
                'numero' => '222',
                'libelle' => 'Client_Devis',
                'created_at' => '2021-02-08 00:00:00',
                'updated_at' => '2021-02-08 00:00:00',
            ),
            8 =>
            array (
                'id' => 9,
                'type' => 'Gestion',
                'famille' => '2',
                'numero' => '223',
                'libelle' => 'Client_Devis_Signes',
                'created_at' => '2021-02-08 00:00:00',
                'updated_at' => '2021-02-08 00:00:00',
            ),
            8 =>
            array (
                'id' => 9,
                'type' => 'Gestion',
                'famille' => '2',
                'numero' => '223',
                'libelle' => 'Client_Devis_Signes',
                'created_at' => '2021-02-08 00:00:00',
                'updated_at' => '2021-02-08 00:00:00',
            ),
            9 =>
            array (
                'id' => 10,
                'type' => 'Gestion',
                'famille' => '2',
                'numero' => '224',
                'libelle' => 'Client_Contrat',
                'created_at' => '2021-02-08 00:00:00',
                'updated_at' => '2021-02-08 00:00:00',
            ),



        ));
    }
}
