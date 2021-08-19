<?php namespace App\Repositories;

use App\Models\chantier;
use App\Models\client;
use App\Models\client_entreprise;
use App\Models\devi_facture;
use App\Models\devi;
use App\Models\facture;
use App\Models\facture_reglement;
use App\Models\reglement;

class QueryTableRepository {

	protected $parametre;

	public function __construct()
	{

	}

  //-------------------------
  // Sauvergader
  //-------------------------

    // Table Facture

    public function save_facture_ajouter($request,$entreprise_id)
    {
      //Sauvergarde de la facture
      $table = new facture;
      $table->numero           = $request->all()['numero'];
      $table->chantier_id      = $request->all()['chantier_id'];
      $table->type_facture_id  = $request->all()['type_facture_id'];
      $table->collaborateur_id = $request->all()['collaborateur_id'];
      $table->total_ht         = $request->all()['total_ht'];
      $table->total_ttc        = $request->all()['total_ttc'];
      $table->date_creation    = $request->all()['date_creation'];
      $table->date_echeance    = $request->all()['date_echeance'];
      if(isset($request->all()['date_envoie'])){
        $table->date_envoie   = $request->all()['date_envoie'];
      }
      if(isset($request->all()['retenuegarantie_ht'])){
        $table->retenuegarantie_ht  = $request->all()['retenuegarantie_ht'];

      }
      $table->entreprise_id = $entreprise_id->id;
      $table->tva           = $request->all()['total_ttc']-$request->all()['total_ht'];
      $table->save();

      return $table;
    }

    public function save_devi_facture($devi_request,$facture_id)
    {
      $i=0;
      foreach ($devi_request as $key => $value) {
        if($i==0){
          //sauvegarde de l'id ud client
          $devis = devi::where('id',$key)->first();
          facture::where('id',$facture_id)->update(['client_id' => $devis->client_id]);
          $i++;
        }

        $table = new devi_facture;
        $table->devi_id    = $key;
        $table->facture_id = $facture_id;
        $table->save();
      }
      return $table;
    }

    // Table reglement

    public function save_reglement_ajouter($request,$entreprise_id)
    {
      //Sauvergarde de la facture
      $table = new reglement;
      $table->numero_releve_compte = $request->all()['numero_releve_compte'];
      $table->valeur_ttc           = $request->all()['valeur_ttc'];
      $table->type_reglement_id     = $request->all()['type_reglement_id'];
      $table->entreprise_id        = $entreprise_id->id;
      $table->client_id            = $request->all()['client_id'];
      $table->date_paye            = $request->all()['date_paye'];
      $table->save();

      return $table;
    }

    public function save_facture_reglement($facture_request,$reglement_id)
    {
      foreach ($facture_request as $key => $value) {
        $table = new facture_reglement;
        $table->facture_id    = $key;
        $table->reglement_id = $reglement_id;
        $table->save();
      }
      return $table;
    }

    public function save_client_entreprise($choix_entrepise)
    {

      foreach ($choix_entrepise as $key => $value) {
        $table = new client_entreprise;
        $table->entreprise_id = $value[0];
        $table->client_id     = $value[1];
        $table->save();
      }

      return $table;
    }

  //-------------------------
  // effacer table
  //-------------------------

    public function delete_devi_factureId($facture_id)
    {
      $table = devi_facture::where('facture_id',$facture_id)->delete();
      return $table;
    }

    public function delete_facture_reglementId($reglement_id)
    {
      $table = facture_reglement::where('reglement_id',$reglement_id)->delete();
      return $table;
    }

    public function delete_entreprise_clientId($client_id)
    {
      $table = client_entreprise::where('client_id',$client_id)->delete();
      return $table;
    }

  //-------------------------
  // update table
  //-------------------------

    public function update_clientId($request,$id,$entreprises)
    {

      foreach ($entreprises as $key_entreprise => $entreprise) {
        foreach ($request as $key_resquest => $value) {
          if('entreprise_'.$entreprise->id==$key_resquest){
            unset($request[$key_resquest]);
          }
        }
      }
      $update =  client::where('id', $id)->update($request);

      return $update;
    }

    public function update_chantierId($request,$id,$entreprises)
    {

      $update =  chantier::where('id', $id)->update($request);

      return $update;
    }

    public function update_deviId($request,$id,$entreprises)
    {

      $update =  devi::where('id', $id)->update($request);

      return $update;
    }

    public function update_factureId($request,$id,$entreprises)
    {

      $update =  facture::where('id', $id)->update($request);

      return $update;
    }

    public function update_reglementId($request,$id,$entreprises)
    {

      $update = reglement::where('id', $id)->update($request);

      return $update;
    }

}
