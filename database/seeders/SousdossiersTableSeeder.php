<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SousdossiersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('sousdossiers')->delete();

        \DB::table('sousdossiers')->insert(array (
            0 =>
            array (
                'id' => 1,
                'libelle' => '11_Documents_Client',
                'created_at' => '2021-01-02 00:00:00',
                'updated_at' => '2021-01-02 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'libelle' => '21_Plans_Client',
                'created_at' => '2021-01-02 00:00:00',
                'updated_at' => '2021-01-02 00:00:00',
            ),
            2 =>
            array (
                'id' => 3,
                'libelle' => '31_Photo_Pré-Etude',
                'created_at' => '2021-01-02 00:00:00',
                'updated_at' => '2021-01-02 00:00:00',
            ),
            3 =>
            array (
                'id' => 4,
                'libelle' => '22_Plans_EDIS',
                'created_at' => '2021-01-02 00:00:00',
                'updated_at' => '2021-01-02 00:00:00',
            ),
            4 =>
            array (
                'id' => 5,
                'libelle' => '32_Photo_Etude',
                'created_at' => '2021-01-02 00:00:00',
                'updated_at' => '2021-01-02 00:00:00',
            ),
            5 =>
            array (
                'id' => 6,
                'libelle' => '33_Photo_Chantier',
                'created_at' => '2021-01-02 00:00:00',
                'updated_at' => '2021-01-02 00:00:00',
            ),
            6 =>
            array (
                'id' => 7,
                'libelle' => '12_Documents_EDIS',
                'created_at' => '2021-01-02 00:00:00',
                'updated_at' => '2021-01-02 00:00:00',
            ),
            7 =>
            array (
                'id' => 8,
                'libelle' => '21_Plans_Client/_old',
                'created_at' => '2021-01-02 00:00:00',
                'updated_at' => '2021-01-02 00:00:00',
            ),
            8 =>
            array (
                'id' => 9,
                'libelle' => '22_Plans_EDIS/_old',
                'created_at' => '2021-01-02 00:00:00',
                'updated_at' => '2021-01-02 00:00:00',
            ),
        ));


    }
}
