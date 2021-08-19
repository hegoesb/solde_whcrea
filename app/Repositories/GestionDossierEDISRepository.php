<?php namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

use App\Repositories\ScriptRepository;

use App\Models\client;
use App\Models\chantier;
use App\Models\dossier;
use App\Models\dossier_etape_chantier;
use App\Models\possible_etape_chantier;
use App\Models\dossier_sousdossier;

class GestionDossierEDISRepository {

	protected $parametre;

	public function __construct(ScriptRepository $ScriptRepository)
	{
    $this->ScriptRepository = $ScriptRepository;
	}

   //-------------------------
  // Nom
  //-------------------------

  public function nomDossier($dossier_id, $entreprise)
  {
    $dossier = dossier::where('id',$dossier_id)->first();
    $data  = $entreprise->prefixe_dossier.'_'.$dossier->numero.'_'.$dossier->libelle;
    return $data;
  }

  public function nomProjet($chantier)
  {
    $client = client::where('id',$chantier->client_id)->first();
    $data  = $chantier->identifiant.'_'.$client->nom.'_'.$chantier->nom;
    return $data;
  }

  public function nomChemin($dossier_id,$chantier,$entreprise)
  {
    $nom_dossier           = $this->nomDossier($dossier_id, $entreprise);
    $nom_projet            = $this->nomProjet($chantier);
    $chemin['dossier_id']  = $dossier_id;
    $chemin['dossier_nom'] = $nom_dossier;
    $chemin['chemin']      = $nom_dossier.'/'.$nom_projet;
    return $chemin;
  }


  //-------------------------
  // Action
  //-------------------------


  public function creerDossier($dossier_id,$chantier, $entreprise)
  {
    $dossier     = dossier::where('id',$dossier_id)->first();
    $sousdossier = dossier_sousdossier::with('sousdossier')->where('dossier_id',$dossier->id)->get();

    $nom_dossier = $this->nomDossier($dossier_id, $entreprise);
    $nom_projet  = $this->nomProjet($chantier);

    $chemin = $nom_dossier.'/'.$nom_projet;

    foreach ($sousdossier as $key => $sd) {
      $root_dossier[$key]=$chemin.'/'.$sd['sousdossier']->libelle;
    }

    foreach ($root_dossier as $key => $rt) {
      Storage::disk('EDIS')->makeDirectory($rt);
    }

    $data = Storage::disk('EDIS')->allDirectories();

    return $data;
  }

  public function supprimerDossier($dossier_id,$chantier,$entreprise)
  {

    $nom_dossier = $this->nomDossier($dossier_id, $entreprise);
    $nom_projet  = $this->nomProjet($chantier);

    $chemin = $nom_dossier.'/'.$nom_projet;

    Storage::disk('EDIS')->deleteDirectory($chemin);

    $data = Storage::disk('EDIS')->allDirectories();

    return $data;
  }

  public function changementNomDossier($chantier_actuel,$dossier_actuel,$chantier_update,$entreprise)
  {

    //Verification du nom de dossier
    $i=2;
    //Verifaction nom chantier
    if($chantier_update->libelle==$chantier_actuel->nom){
      $i--;
    }
    //Verifaction client
    if($chantier_update->client_id==$chantier_actuel->client_id){
      $i--;
    }
    if($i>0){ //Le changement de nom doit être fait
      foreach ($dossier_actuel as $key_da => $da) {
          $nom_dossier            = $this->nomDossier($da['dossier']->id, $entreprise);
          $nom_projet_actuel      = $this->nomProjet($chantier_actuel);
          $nom_projet_update      = $this->nomProjet($chantier_update);
          $chemin_array[$nom_dossier]['dossier'] =$nom_dossier;
          $chemin_array[$nom_dossier]['dossier_id'] =$da['dossier']->id;
          $chemin_array[$nom_dossier]['chemin_actuel'] =$nom_dossier.'/'.$nom_projet_actuel;
          $chemin_array[$nom_dossier]['projet_actuel'] =$nom_projet_actuel;
          $chemin_array[$nom_dossier]['projet_actuel_exist'] =0;
          $chemin_array[$nom_dossier]['chemin_update'] =$nom_dossier.'/'.$nom_projet_update;
      }
      //On vérifie si le dossier existe bien
      $liste_dossier = $this->ScriptRepository->lsNextcloud_arrayChemin($chemin_array, $entreprise);
      foreach ($chemin_array as $key_c => $c) {//Boucle du dossier d'origine
        foreach ($liste_dossier[$key_c][0] as $key_ld => $ld) {
          if($ld==$c['projet_actuel']){
            $chemin_array[$key_c]['projet_actuel_exist'] =1;
          }
        }
      }
      foreach ($chemin_array as $key_c => $c) {//Boucle du dossier d'origine
        //Si le dossier existe on change de nom
        if($c['projet_actuel_exist'] ==1){
          $data=$this->ScriptRepository->mvNomNextcloud($c,$entreprise);
          $data=$this->ScriptRepository->scanNextcloud($c['dossier']);
        }else{//Sinon on crée un dossier
          $data = $this->creerDossier($c['dossier_id'],$chantier_update, $entreprise);
          $data=$this->ScriptRepository->scanNextcloud($c['dossier']);
        }
      }

    }else{
      $data='Aucun changement de nom';
    }

    return $data;
  }


  public function deplacementDossier($chantier_actuel,$entreprise)
  {
    $chantier_update = chantier::where('id',$chantier_actuel->id)->first();

    //Récupération des dossiers
    $dossier_actuel = dossier_etape_chantier::with('etape_chantier','dossier')->where('etape_chantier_id',$chantier_actuel->etape_chantier_id)->get();

    $dossier_update = dossier_etape_chantier::with('etape_chantier','dossier')->where('etape_chantier_id',$chantier_update->etape_chantier_id)->get();

    //Changement de nom du dossier ou création si le dossier n'existe pas.
    $data = $this->changementNomDossier($chantier_actuel,$dossier_actuel,$chantier_update,$entreprise);

    //Récupération des possibles étapes
    $possibles = possible_etape_chantier::where('etape_chantier_id',$chantier_actuel->etape_chantier_id)->get();

    //si pas même étape
    if($chantier_actuel->etape_chantier_id!=$chantier_update->etape_chantier_id){
      //Comparaison des possibles avec l'étape update, pour vérifier si on a le droit.
      foreach ($possibles as $key_p => $possible) {
        if($possible->possible_id==$chantier_update->etape_chantier_id){
          foreach ($dossier_actuel as $key_da => $da) {
            if($da['dossier']->id!=5){ // Construction du chemin de dossier existant
              $chemin_actuel = $this->nomChemin($da['dossier']->id, $chantier_actuel, $entreprise);
            }
          }
          foreach ($dossier_update as $key_da => $da) { // Construction du nouveau chemin de dossier
            if($da['dossier']->id!=5){
              $chemin_update = $this->nomChemin($da['dossier']->id, $chantier_actuel, $entreprise);
            }
          }
          //Déplacement du dossier
          $data=$this->ScriptRepository->mvNextcloud($chemin_actuel,$chemin_update, $entreprise);
          //Scan de l'ancien dossier parent et du nouveau dossier parent
          $data=$this->ScriptRepository->scanNextcloud($chemin_update['dossier_nom']);
          $data=$this->ScriptRepository->scanNextcloud($chemin_actuel['dossier_nom']);
          //Création des dossiers qu'implique le nouveau dossier parent
          $data=$this->creerDossier($chemin_update['dossier_id'],$chantier_update, $entreprise);
          //Si etape_chantier_id = 3: en cours
          if($chantier_update->etape_chantier_id==3){
            foreach ($dossier_update as $key_da => $da) { // Construction du nouveau chemin de dossier
              if($da['dossier']->id==5){
                $data=$this->creerDossier($da['dossier']->id,$chantier_update, $entreprise);
              }
            }
          }
        }
      }
    }

    return $data;
  }

}
