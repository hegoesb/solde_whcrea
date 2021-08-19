<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(generic_table::class);
        $this->call(ChantiersTableSeeder::class);
        $this->call(DevisTableSeeder::class);
        $this->call(DeviFactureTableSeeder::class);
        $this->call(FacturesTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(ClientEntrepriseTableSeeder::class);
        $this->call(ReglementsTableSeeder::class);
        $this->call(FactureReglementTableSeeder::class);
        $this->call(PossibleEtapeChantiersTableSeeder::class);
        $this->call(SousdossiersTableSeeder::class);
        $this->call(DossiersTableSeeder::class);
        $this->call(DossierEtapeChantiersTableSeeder::class);
        $this->call(BigrammesTableSeeder::class);
        $this->call(DossierSousdossierTableSeeder::class);
        $this->call(TypeDocumentsTableSeeder::class);
    }
}
