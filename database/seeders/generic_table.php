<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class generic_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('collaborateurs')->delete();
        \DB::table('collaborateurs')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nom' => 'FHU',
                'nom_display' => 'Fabien Hegoburu',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'nom' => 'AFR',
                'nom_display' => 'Antoine Fournier',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            2 =>
            array (
                'id' => 3,
                'nom' => 'RCS',
                'nom_display' => 'Remy Carpentras',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
        ));


        \DB::table('entreprises')->delete();
        \DB::table('entreprises')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nom' => 'EBX',
                'nom_display' => 'EDIS Bordeaux',
                'prefixe_chantier' => 'EBX_PJ',
                'prefixe_devis' => 'EBX_DE',
                'prefixe_facture' => 'EBX_FA',
                'prefixe_dossier' => 'BDX',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'nom' => 'EPB',
                'nom_display' => 'EDIS Pays Basque',
                'prefixe_chantier' => 'EPB_PJ',
                'prefixe_devis' => 'EPB_DE',
                'prefixe_facture' => 'EPB_FA',
                'prefixe_dossier' => 'PB',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
        ));

        \DB::table('type_clients')->delete();
        \DB::table('type_clients')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nom' => 'Pro',
                'nom_display' => 'Professionel',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'nom' => 'Par',
                'nom_display' => 'Particulier',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
        ));

        \DB::table('type_devis')->delete();
        \DB::table('type_devis')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nom' => 'P',
                'nom_display' => 'Principal',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'nom' => 'A',
                'nom_display' => 'Additif',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
        ));

        \DB::table('type_factures')->delete();
        \DB::table('type_factures')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nom' => 'Ac',
                'nom_display' => 'Acompte',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'nom' => 'Sit',
                'nom_display' => 'Situation',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            2 =>
            array (
                'id' => 3,
                'nom' => 'Sol',
                'nom_display' => 'Solde',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
        ));

        \DB::table('type_reglements')->delete();
        \DB::table('type_reglements')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nom' => 'Vir',
                'nom_display' => 'Virement',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'nom' => 'Ch',
                'nom_display' => 'Chéque',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
        ));

        \DB::table('etape_chantiers')->delete();
        \DB::table('etape_chantiers')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nom' => '1-NG',
                'nom_display' => 'Negociation',
                'color' => 'warning',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'nom' => '2-SG',
                'nom_display' => 'Signé',
                'color' => 'success',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            2 =>
            array (
                'id' => 3,
                'nom' => '3-EC',
                'nom_display' => 'En Cours',
                'color' => 'primary',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            3 =>
            array (
                'id' => 4,
                'nom' => '4-TR',
                'nom_display' => 'Chantier Terminé',
                'color' => 'dark',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            4 =>
            array (
                'id' => 5,
                'nom' => '5-SD',
                'nom_display' => 'Chantier Soldé (Archiver)',
                'color' => 'light-dark',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            5 =>
            array (
                'id' => 6,
                'nom' => '6-LI',
                'nom_display' => 'Litige',
                'color' => 'danger',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            6 =>
            array (
                'id' => 7,
                'nom' => '7-PU',
                'nom_display' => 'Perdu',
                'color' => 'light-danger',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
        ));

        \DB::table('etat_devis')->delete();
        \DB::table('etat_devis')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nom' => 'N',
                'nom_display' => 'Negociation',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'nom' => 'A',
                'nom_display' => 'Accepté',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            2 =>
            array (
                'id' => 3,
                'nom' => 'S',
                'nom_display' => 'Signé',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),
            3 =>
            array (
                'id' => 4,
                'nom' => 'R',
                'nom_display' => 'Refusé',
                'created_at' => '2020-12-12 00:00:00',
                'updated_at' => '2020-12-12 00:00:00',
            ),

        ));
    }
}
