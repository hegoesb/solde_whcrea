<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EdisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //-------------------------
        // Entreprises
        //-------------------------

        Schema::create('entreprises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom',10);
            $table->string('nom_display',20);
            $table->string('prefixe_chantier',15);
            $table->string('prefixe_devis',15);
            $table->string('prefixe_facture',15);
            $table->string('prefixe_dossier',15);
            $table->timestamps();
        });

        Schema::create('collaborateurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom',3);
            $table->string('nom_display',20);
            $table->timestamps();
        });

        //-------------------------
        // Clients
        //-------------------------

        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_client_id')->nullable();
            $table->string('nom',10);
            $table->string('nom_display',40);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('client_entreprise', function (Blueprint $table) {
            $table->integer('client_id')->unsigned();
            $table->integer('entreprise_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        //-------------------------
        // Types
        //-------------------------

        Schema::create('type_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom',4);
            $table->string('nom_display',20);
            $table->timestamps();
        });

        Schema::create('type_devis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom',4);
            $table->string('nom_display',20);
            $table->timestamps();
        });
        Schema::create('type_factures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom',4);
            $table->string('nom_display',20);
            $table->timestamps();
        });
        Schema::create('type_reglements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom',4);
            $table->string('nom_display',20);
            $table->timestamps();
        });
        Schema::create('type_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom',4);
            $table->string('nom_display',20);
            $table->timestamps();
        });

        //-------------------------
        // Dossier
        //-------------------------

        Schema::create('dossiers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('famille',1);
            $table->string('type',15);
            $table->string('numero',20);
            $table->string('libelle',20);
            $table->timestamps();
        });

        Schema::create('sousdossiers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libelle',20);
            $table->timestamps();
        });

        Schema::create('dossier_sousdossier', function (Blueprint $table) {
            $table->integer('dossier_id')->unsigned();
            $table->integer('sousdossier_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bigrammes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom',3);
            $table->string('nom_display',35);
            $table->integer('sousdossier_id');
            $table->timestamps();
        });


        //-------------------------
        // Etat
        //-------------------------

        Schema::create('etape_chantiers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom',4);
            $table->string('nom_display',30);
            $table->string('color',25);
            $table->timestamps();
        });
        Schema::create('possible_etape_chantiers', function (Blueprint $table) {
            $table->integer('etape_chantier_id')->unsigned();
            $table->integer('possible_id')->unsigned();
            $table->timestamps();
        });
        Schema::create('dossier_etape_chantiers', function (Blueprint $table) {
            $table->integer('etape_chantier_id')->unsigned();
            $table->integer('dossier_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('etat_devis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom',4);
            $table->string('nom_display',20);
            $table->timestamps();
        });
        //-------------------------
        // Chantier
        //-------------------------

        Schema::create('chantiers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identifiant',15);
            $table->string('nom',15);
            $table->string('libelle',50)->nullable();
            $table->integer('client_id');
            $table->integer('entreprise_id');
            $table->integer('etape_chantier_id');
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('devis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero',15);
            $table->string('lot',50)->nullable();
            $table->integer('chantier_id');
            $table->integer('entreprise_id');
            $table->integer('client_id');
            $table->integer('bilan_id')->nullable();
            $table->integer('etat_devi_id');
            $table->integer('type_devi_id');
            $table->integer('collaborateur_id');
            $table->float('total_ht', 10, 2)->nullable();
            $table->float('total_ttc', 10, 2)->nullable();
            $table->float('tva', 10, 2)->nullable();
            $table->boolean('progbox_sauve')->nullable();
            $table->date('date_creation');
            $table->date('date_envoie')->nullable();
            $table->date('date_signature')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


        //-------------------------
        // reglements
        //-------------------------

        Schema::create('factures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero',15);
            $table->integer('chantier_id');
            $table->integer('client_id')->nullable();
            $table->integer('bilan_id')->nullable();
            $table->integer('entreprise_id');
            $table->integer('type_facture_id');
            $table->float('total_ht', 10, 2);
            $table->float('total_ttc', 10, 2);
            $table->float('tva', 10, 2)->nullable();
            $table->integer('collaborateur_id');
            $table->integer('retenuegarantie_ht')->nullable();
            $table->date('date_creation');
            $table->date('date_echeance');
            $table->date('date_envoie')->nullable();
            $table->date('date_paye')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('reglements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_releve_compte',4);
            $table->integer('client_id');
            $table->integer('entreprise_id');
            $table->float('valeur_ttc', 10, 2);
            $table->date('date_paye');
            $table->integer('type_reglement_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('facture_reglement', function (Blueprint $table) {
            $table->integer('facture_id')->unsigned();
            $table->integer('reglement_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('devi_facture', function (Blueprint $table) {
            $table->integer('devi_id')->unsigned();
            $table->integer('facture_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        //-------------------------
        // Entreprises
        //-------------------------

        Schema::dropIfExists('entreprises');
        Schema::dropIfExists('collaborateurs');

        //-------------------------
        // Clients
        //-------------------------

        Schema::dropIfExists('clients');
        Schema::dropIfExists('client_entreprise');

        //-------------------------
        // Types
        //-------------------------

        Schema::dropIfExists('type_clients');
        Schema::dropIfExists('type_devis');
        Schema::dropIfExists('type_factures');
        Schema::dropIfExists('type_reglements');
        Schema::dropIfExists('type_documents');

        //-------------------------
        // Etat
        //-------------------------

        Schema::dropIfExists('etape_chantiers');
        Schema::dropIfExists('possible_etape_chantiers');
        Schema::dropIfExists('dossier_etape_chantiers');
        Schema::dropIfExists('etat_devis');

        //-------------------------
        // Chantier
        //-------------------------

        Schema::dropIfExists('chantiers');
        Schema::dropIfExists('devis');

        //-------------------------
        // reglements
        //-------------------------

        Schema::dropIfExists('factures');
        Schema::dropIfExists('reglements');
        Schema::dropIfExists('facture_reglement');
        Schema::dropIfExists('devi_facture');

        //-------------------------
        // Dossier
        //-------------------------

        Schema::dropIfExists('dossiers');
        Schema::dropIfExists('sousdossiers');
        Schema::dropIfExists('dossier_sousdossier');
        Schema::dropIfExists('bigrammes');

    }
}
