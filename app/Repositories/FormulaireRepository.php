<?php namespace App\Repositories;

use App\Models\chantier;
use App\Models\client;
use App\Models\collaborateur;
use App\Models\devi;
use App\Models\devi_facture;
use App\Models\entreprise;
use App\Models\etape_chantier;
use App\Models\possible_etape_chantier;
use App\Models\type_client;
use App\Models\type_devi;
use App\Models\type_facture;
use App\Models\type_reglement;

class FormulaireRepository {

	protected $parametre;

	public function __construct()
	{

	}
  //-------------------------
  // Entreprise
  //-------------------------

  public function select_entreprises()
  {
    $datas=entreprise::get();
    foreach ($datas as $key_2 => $value) {
      $data[$key_2][0]=$value['id'];
      $data[$key_2][1]=$value['nom_display'];
    }
    return $data;
  }

  public function select_entreprises_checked($client)
  {
    $datas=entreprise::get();
    foreach ($datas as $key_2 => $value) {
      $data[$key_2][0]=$value['id'];
      $data[$key_2][1]=$value['nom_display'];
      $data[$key_2][2]=0;
      foreach ($client['entreprise'] as $key_cl => $value_cl) {
        if ($value['id'] == $value_cl->id){
          $data[$key_2][2]=1;
        }
      }
    }
    return $data;
  }

  //-------------------------
  // Client
  //-------------------------

  public function select_type_clients()
  {
    $datas=type_client::get();
    foreach ($datas as $key_1 => $value) {
      $data[$key_1][0]=$value['id'];
      $data[$key_1][1]=$value['nom_display'];
    }
    return $data;
  }

  public function select_clients($entreprise)
  {
    $datas=entreprise::with('client')->where('id',$entreprise->id)->first();
    foreach ($datas['client'] as $key_2 => $value) {
      $data[$key_2][0]=$value['id'];
      $data[$key_2][1]=$value['nom_display'];
    }
    return $data;
  }

  public function select_clients_checked($entreprise,$table)
  {
    $datas=client::get();
    foreach ($datas as $key_2 => $value) {
      $data[$key_2][0]=$value['id'];
      $data[$key_2][1]=$value['nom_display'];
      $data[$key_2][2]=0;
      if ($value['id'] == $table->client_id){
        $data[$key_2][2]=1;
      }
    }
    return $data;
  }


  //-------------------------
  // Chantier
  //-------------------------

	public function select_chantiers($entreprise)
	{
    $datas=chantier::with('client')->where('entreprise_id',$entreprise->id)->orderBy('identifiant','desc')->get();
    foreach ($datas as $key => $value) {
      $data[$key][0]=$value['id'];
      $data[$key][1]=$value['identifiant'].' - '.$value['nom'].' ('.$value['libelle'].')';
    }
    return $data;
	}

  public function select_chantiers_checked($entreprise,$table)
  {
    $datas=chantier::with('client')->where('entreprise_id',$entreprise->id)->orderBy('identifiant','desc')->get();
    foreach ($datas as $key => $value) {
      $data[$key][0]=$value['id'];
      $data[$key][1]=$value['identifiant'].' - '.$value['nom'].' ('.$value['libelle'].')';
      $data[$key][2]=0;
      if ($value['id'] == $table->chantier_id){
        $data[$key][2]=1;
      }
    }
    return $data;
  }

  public function select_etapes_chantier_checked($entreprise,$table)
  {

    // Etape chantier possible;
    $datas = possible_etape_chantier::where('etape_chantier_id',$table->etape_chantier_id)->get();

    foreach ($datas as $key => $d) {
      $value = etape_chantier::where('id',$d->possible_id)->first();
      $data[$key][0]=$value->id;
      $data[$key][1]=$value->nom_display;
      $data[$key][2]=0;
      if ($value->id == $table->etape_chantier_id){
        $data[$key][2]=1;
      }
    }
    return $data;
  }

  //-------------------------
  // Devis
  //-------------------------

  public function select_type_devis()
  {
    $datas=type_devi::get();
    foreach ($datas as $key => $value) {
      $data[$key][0]=$value['id'];
      $data[$key][1]=$value['nom_display'];
    }
    return $data;
  }

  public function select_type_devis_checked($entreprise,$table)
  {
    $datas=type_devi::get();
    foreach ($datas as $key => $value) {
      $data[$key][0]=$value['id'];
      $data[$key][1]=$value['nom_display'];
      $data[$key][2]=0;
      if ($value['id'] == $table->type_devi_id){
        $data[$key][2]=1;
      }
    }
    return $data;
  }

  //-------------------------
  // Facture
  //-------------------------

  public function select_type_factures()
  {
    $datas=type_facture::get();
    foreach ($datas as $key => $value) {
      $data[$key][0]=$value['id'];
      $data[$key][1]=$value['nom_display'];
    }
    return $data;
  }

  public function select_type_factures_checked($entreprise,$table)
  {
    $datas=type_facture::get();
    foreach ($datas as $key => $value) {
      $data[$key][0]=$value['id'];
      $data[$key][1]=$value['nom_display'];
      $data[$key][2]=0;
      if ($value['id'] == $table->type_facture_id){
        $data[$key][2]=1;
      }
    }
    return $data;
  }

  //-------------------------
  // Collaborateur
  //-------------------------

  public function select_collaborateurs()
  {
    $datas=collaborateur::orderBy('nom','asc')->get();
    foreach ($datas as $key_2 => $value) {
      $data[$key_2][0]=$value['id'];
      $data[$key_2][1]=$value['nom_display'];
    }
    return $data;
  }

  public function select_collaborateurs_checked($entreprise,$table)
  {
    $datas=collaborateur::orderBy('nom','asc')->get();
    foreach ($datas as $key => $value) {
      $data[$key][0]=$value['id'];
      $data[$key][1]=$value['nom_display'];
      $data[$key][2]=0;
      if ($value['id'] == $table->collaborateur_id){
        $data[$key][2]=1;
      }
    }
    return $data;
  }
  //-------------------------
  // devi_facture
  //-------------------------

  //Selection des devis chantiers et la liaison devi_facture existante
  public function select_devi_chantierFacture($facture)
  {
    //Selection des devis en rapport avec le chantier de la facture
    $devis = devi::where('chantier_id',$facture->chantier_id)->get();
    //Comparatif devis lié au chantier et les devis lié a la facture + préparation donné formulaire
    foreach ($devis as $key_devis => $value_devis) {
      $data[$key_devis]['id'] = $value_devis->id;
      $data[$key_devis]['nom'] = $value_devis->numero;
      $data[$key_devis]['liaison_facture'] = 0;
      if(isset($facture['devi'])){
        foreach ($facture['devi'] as $key_devi => $value_devi) {
          if($value_devi->id == $value_devis->id){
            $data[$key_devis]['liaison_facture'] = 1;
            $break;
          }
        }
      }
    }

    return $data;
  }

  //-------------------------
  // Réglement
  //-------------------------

  public function select_type_reglements()
  {
    $datas=type_reglement::get();
    foreach ($datas as $key => $value) {
      $data[$key][0]=$value['id'];
      $data[$key][1]=$value['nom_display'];
    }
    return $data;
  }

  public function select_type_reglements_checked($entreprise,$table)
  {
    $datas=type_reglement::get();
    foreach ($datas as $key => $value) {
      $data[$key][0]=$value['id'];
      $data[$key][1]=$value['nom_display'];
      $data[$key][2]=0;
      if ($value['id'] == $table->type_reglement_id){
        $data[$key][2]=1;
      }
    }
    return $data;
  }

  //Selection des devis chantiers et la liaison devi_facture existante
  public function select_facture_clientPaiement($factures)
  {
    //Comparatif devis lié au chantier et les devis lié a la facture + préparation donné formulaire
    $data=0;
    foreach ($factures as $key_devis => $value_factures) {
      $data[$key_devis]['id'] = $value_factures->id;
      $data[$key_devis]['nom'] = $value_factures->numero;
      $data[$key_devis]['liaison_facture'] = 0;
      if(isset($facture['devi'])){
        foreach ($facture['devi'] as $key_devi => $value_devi) {
          if($value_devi->id == $value_factures->id){
            $data[$key_devis]['liaison_facture'] = 1;
            $break;
          }
        }
      }
    }

    return $data;
  }

  //-------------------------
  // Progbox
  //-------------------------

  public function select_progbox_checked($entreprise,$table)
  {
    $data[0][0]=false;
    $data[0][1]='Non';
    $data[0][2]=0;
    $data[1][0]=true;
    $data[1][1]='Oui';
    $data[1][2]=0;
    foreach ($data as $key => $value) {
      if ($value[0] == $table->progbox_sauve){
        $data[$key][2]=1;
      }
    }
    return $data;
  }
}
