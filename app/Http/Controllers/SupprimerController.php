<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\GestionDossierEDISRepository;
use App\Repositories\ScriptRepository;

use App\Models\chantier;
use App\Models\devi;
use App\Models\devi_facture;
use App\Models\entreprise;
use App\Models\facture_reglement;
use App\Models\facture;
use App\Models\reglement;

class SupprimerController extends Controller
{

    public function __construct(GestionDossierEDISRepository $GestionDossierEDISRepository,ScriptRepository $ScriptRepository)
    {
        $this->chemin_supprimer      = 'pages.supprimer.';
        $this->GD_EDIS              = $GestionDossierEDISRepository;
        $this->ScriptRepository     = $ScriptRepository;
    }


    //-------------------------
    // View
    //-------------------------

    public function viewSupprimer($entreprise_id,$table,$id)
    {
      //Selection nom de l'entreprise pour le titre de la page
      $entreprise=entreprise::where('id',$entreprise_id)->first();

      if($table=='chantiers'){
        //Vérification qu'aucun devis n'exsite pour le chantier, sinon on supprime pas.
        $verif = devi::where('entreprise_id',$entreprise->id)->where('chantier_id',$id)->first();
        if(!isset($verif)){
          $chantier_deleted = chantier::where('entreprise_id',$entreprise->id)->where('id',$id)->first();
          if(isset($chantier_deleted)){
            //Suppression du dossier chantier
            $data        = $this->GD_EDIS->supprimerDossier(1,$chantier_deleted,$entreprise);
            $nom_dossier = $this->GD_EDIS->nomDossier(1, $entreprise);
            $output      = $this->ScriptRepository->scanNextcloud($nom_dossier);
            $chantier_deleted->delete();
          }
        }

      }elseif($table=='devis'){

        //Vérification qu'aucune facture n'exsite pour le devis, sinon on supprime pas.
        $verif = devi_facture::where('devi_id',$id)->first();
        if(!isset($verif)){
          $devi_deleted = devi::where('entreprise_id',$entreprise->id)->where('id',$id)->first();
          if(isset($devi_deleted)){
            $devi_deleted->delete();
          }
        }

      }elseif($table=='factures'){

        //Vérification qu'aucune facture n'exsite pour le devis, sinon on supprime pas.
        $verif = facture_reglement::where('facture_id',$id)->first();
        if(!isset($verif)){
          $facture_deleted = facture::where('entreprise_id',$entreprise->id)->where('id',$id)->first();
          if(isset($facture_deleted)){
            $facture_deleted->delete();
          }
        }

      }elseif($table=='reglements'){

        $reglement_deleted = reglement::where('entreprise_id',$entreprise->id)->where('id',$id)->first();
          // return view('test', ['test' =>  $reglement_deleted , 'imputs' => $id, 'comp' => $entreprise->id]);
        if(isset($reglement_deleted)){
          $reglement_deleted->delete();
        }
        $liaison_deleted = facture_reglement::where('reglement_id',$id)->get();
        if(isset($liaison_deleted[0])){
          $liaison_deleted->delete();
        }
      }


      return redirect('/tableau/'.$entreprise->id.'/'.$table);

    }
}
