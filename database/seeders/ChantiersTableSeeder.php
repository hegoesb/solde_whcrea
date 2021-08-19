<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChantiersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('chantiers')->delete();
        
        \DB::table('chantiers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'identifiant' => 'EBX_PJ2012-0014',
                'nom' => 'Ballanger',
                'libelle' => 'Ballanger-Antenne',
                'client_id' => 10,
                'entreprise_id' => 1,
                'etape_chantier_id' => 3,
                'date_debut' => '2020-12-14',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 10:21:40',
                'updated_at' => '2021-01-16 15:38:22',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'identifiant' => 'EBX_PJ2001-0044',
                'nom' => 'Marcet',
                'libelle' => 'Marcet',
                'client_id' => 1,
                'entreprise_id' => 1,
                'etape_chantier_id' => 1,
                'date_debut' => '2020-12-07',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 11:32:49',
                'updated_at' => '2020-12-18 11:32:49',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'identifiant' => 'EBX_PJ2003-0066',
                'nom' => 'Bataille',
                'libelle' => 'SCCV GUJAN BATAILLE',
                'client_id' => 2,
                'entreprise_id' => 1,
                'etape_chantier_id' => 1,
                'date_debut' => '2020-12-07',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 11:33:53',
                'updated_at' => '2020-12-18 11:33:53',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'identifiant' => 'EBX_PJ2004-0067',
                'nom' => 'Massia',
                'libelle' => 'Massia',
                'client_id' => 4,
                'entreprise_id' => 1,
                'etape_chantier_id' => 1,
                'date_debut' => '2020-12-07',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 11:34:31',
                'updated_at' => '2020-12-18 11:34:31',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'identifiant' => 'EBX_PJ2005-0071',
                'nom' => 'Cambes',
                'libelle' => 'Cambes - 22 Maisons',
                'client_id' => 1,
                'entreprise_id' => 1,
                'etape_chantier_id' => 1,
                'date_debut' => '2020-06-15',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 11:35:22',
                'updated_at' => '2020-12-18 11:35:22',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'identifiant' => 'EBX_PJ2005-0074',
                'nom' => 'Mussard',
                'libelle' => 'Mussard',
                'client_id' => 1,
                'entreprise_id' => 1,
                'etape_chantier_id' => 1,
                'date_debut' => '2020-12-07',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 11:41:55',
                'updated_at' => '2020-12-18 11:41:55',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'identifiant' => 'EBX_PJ2009-0089',
                'nom' => 'Boyer',
                'libelle' => 'Boyer',
                'client_id' => 3,
                'entreprise_id' => 1,
                'etape_chantier_id' => 1,
                'date_debut' => '2020-12-07',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 11:42:44',
                'updated_at' => '2020-12-18 11:42:44',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'identifiant' => 'EBX_PJ2010-0001',
                'nom' => 'Joandet',
                'libelle' => 'Joandet',
                'client_id' => 5,
                'entreprise_id' => 1,
                'etape_chantier_id' => 1,
                'date_debut' => '2020-12-07',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 11:43:33',
                'updated_at' => '2020-12-18 11:43:33',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'identifiant' => 'EBX_PJ2010-0002',
                'nom' => 'Rosina',
                'libelle' => 'Rosina',
                'client_id' => 3,
                'entreprise_id' => 1,
                'etape_chantier_id' => 1,
                'date_debut' => '2020-12-07',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 11:44:08',
                'updated_at' => '2020-12-18 11:44:08',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'identifiant' => 'EBX_PJ2010-0003',
                'nom' => 'Larmée',
                'libelle' => 'Larmée',
                'client_id' => 1,
                'entreprise_id' => 1,
                'etape_chantier_id' => 1,
                'date_debut' => '2020-12-07',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 11:44:41',
                'updated_at' => '2020-12-18 11:44:41',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'identifiant' => 'EBX_PJ2010-0004',
                'nom' => 'Lanton',
                'libelle' => 'Lanton - SCCV 45 Avenue de la Libération',
                'client_id' => 1,
                'entreprise_id' => 1,
                'etape_chantier_id' => 1,
                'date_debut' => '2020-12-07',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 11:45:25',
                'updated_at' => '2020-12-18 11:45:25',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'identifiant' => 'EBX_PJ2011-0006',
                'nom' => 'Daiva',
                'libelle' => 'Daiva',
                'client_id' => 1,
                'entreprise_id' => 1,
                'etape_chantier_id' => 1,
                'date_debut' => '2020-12-07',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 11:46:07',
                'updated_at' => '2020-12-18 11:46:07',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'identifiant' => 'EBX_PJ2011-0007',
                'nom' => 'Roullin',
                'libelle' => 'Roullin',
                'client_id' => 1,
                'entreprise_id' => 1,
                'etape_chantier_id' => 1,
                'date_debut' => '2020-12-07',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 11:46:39',
                'updated_at' => '2020-12-18 11:46:39',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'identifiant' => 'EBX_PJ2011-0009',
                'nom' => 'D&I 2020',
                'libelle' => 'Dépannage et intervention 2020',
                'client_id' => 1,
                'entreprise_id' => 1,
                'etape_chantier_id' => 1,
                'date_debut' => '2020-12-07',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 11:47:22',
                'updated_at' => '2020-12-18 11:47:22',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'identifiant' => 'EBX_PJ2012-0010',
                'nom' => 'Moles',
                'libelle' => 'Moles',
                'client_id' => 1,
                'entreprise_id' => 1,
                'etape_chantier_id' => 3,
                'date_debut' => '2020-12-07',
                'date_fin' => NULL,
                'created_at' => '2020-12-18 11:47:45',
                'updated_at' => '2021-01-17 09:01:57',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}