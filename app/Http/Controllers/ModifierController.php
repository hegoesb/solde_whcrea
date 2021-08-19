<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\FormulaireRepository;
use App\Repositories\QueryTableRepository;
use App\Repositories\TraitementRepository;
use App\Repositories\GestionDossierEDISRepository;

use App\Models\client;
use App\Models\chantier;
use App\Models\devi;
use App\Models\dossier_etape_chantier;
use App\Models\entreprise;
use App\Models\facture;
use App\Models\facture_reglement;
use App\Models\possible_etape_chantier;
use App\Models\reglement;

class ModifierController extends Controller
{

    public function __construct(FormulaireRepository $FormulaireRepository,QueryTableRepository $QueryTableRepository,GestionDossierEDISRepository $GestionDossierEDISRepository, TraitementRepository $TraitementRepository)
    {
        $this->chemin_modifier      = 'pages.modifier.';
        $this->formulaireRepository = $FormulaireRepository;
        $this->QueryTableRepository = $QueryTableRepository;
        $this->TraitementRepository = $TraitementRepository;
        $this->GD_EDIS              = $GestionDossierEDISRepository;
    }

    //-------------------------
    // View
    //-------------------------

    public function viewModifier($entreprise_id,$table,$id)
    {

      //Selection nom de l'entreprise pour le titre de la page
      $entreprise=entreprise::where('id',$entreprise_id)->first();

      if($table=='devi_facture'){
        $facture = facture::with('chantier','devi')->where('id',$id)->first();
        // return view('test', ['test' =>  $facture, 'imputs' => '$a', 'comp' => '$table']);

        //Selection des devis chantiers et la liaison devi_facture existante
        $data = $this->formulaireRepository->select_devi_chantierFacture($facture);

        // return view('test', ['test' =>  $data, 'imputs' => '$a', 'comp' => '$table']);

        return view($this->chemin_modifier.$table.'_modif2',[
            'titre'      => $entreprise['nom'].' - Associer une facture aux devis - [Facture : '.$facture['numero'].']',
            'descriptif1' => "Associer la facture",
            'descriptif2' => $facture['numero'],
            'descriptif3' => " aux devis ci-dessous. (Certains devis peuvent déjà être rattachés).",
            'facture'    => $facture,
            'entreprise' => $entreprise,
            'data' =>$data,
        ]);
      }elseif($table=='facture_reglement'){
        $reglement = reglement::with('client')->where('id',$id)->first();
        $factures= facture::where('client_id',$reglement->client_id)->get();
        // return view('test', ['test' => $reglement, 'imputs' => '$a', 'comp' => '$table']);

        //Selection des devis clients et la liaison devi_facture existante
        $data = $this->formulaireRepository->select_facture_clientPaiement($factures);

        // return view('test', ['test' =>  $data, 'imputs' => '$a', 'comp' => '$table']);

        return view($this->chemin_modifier.$table.'_modif2',[
            'titre'      => $entreprise['nom'].' - Associer un reglement aux factures - [Paiement : '.$reglement['numero_releve_compte'].'-'.$reglement['client']['nom'].'-'.$reglement['valeur_ttc'].'€]',
            'descriptif1' => "Associer le reglement",
            'descriptif2' => $reglement['numero_releve_compte'].'-'.$reglement['client']['nom'].'-'.$reglement['valeur_ttc'].'€',
            'descriptif3' => " aux factures ci-dessous. (Certaines factures peuvent déjà être rattachées).",
            'reglement'    => $reglement,
            'entreprise' => $entreprise,
            'data' =>$data,
        ]);
      }elseif($table=='clients'){

        //Selection de données nécessaire au formulaire
        $type_client              = $this->formulaireRepository->select_type_clients();
        $client                   = client::with('entreprise', 'type_client')->where('id',$id)->first();
        $choix_entreprise_checked = $this->formulaireRepository->select_entreprises_checked($client);
        $lien                     = '/tableau/'.$entreprise_id.'/'.$table;

        // return view('test', ['test' =>  $choix_entreprise_checked, 'imputs' => $client['entreprise'][0], 'comp' => '$table'.' ']);

        return view($this->chemin_modifier.$table.'_modif2',[
            'titre'            => $entreprise['nom'].' - Modifier un client',
            'descriptif'       => 'Le client sera modifié à la table client commune aux deux entreprises. Un client peut appartenir aux deux entreprises',
            'client'           => $client,
            'lien'             => $lien,
            'type_client'      => $type_client,
            'choix_entreprise' => $choix_entreprise_checked,
            'entreprise_id'    => $entreprise->id,
        ]);
      }elseif($table=='chantiers'){

        //Selection de données nécessaire au formulaire
        $chantier             = chantier::with('entreprise', 'etape_chantier')->where('id',$id)->first();
        $type_client          = $this->formulaireRepository->select_type_clients();
        $choix_client_checked = $this->formulaireRepository->select_clients_checked($entreprise_id,$chantier);
        $choix_etapes_checked = $this->formulaireRepository->select_etapes_chantier_checked($entreprise_id,$chantier);
        $lien                 = '/tableau/'.$entreprise_id.'/'.$table;

        // return view('test', ['test' =>  $choix_etapes_checked, 'imputs' => '', 'comp' => '$table'.' ']);

        return view($this->chemin_modifier.$table.'_modif2',[
            'titre'        => $entreprise['nom'].' - Modifier un chantier',
            'descriptif'   => 'Le chantier sera associé à l\'entreprise '.$entreprise['nom_display'].'.',
            'chantier'     => $chantier,
            'entreprise'   => $entreprise,
            'lien'         => $lien,
            'type_client'  => $type_client,
            'choix_client' => $choix_client_checked,
            'choix_etape'  => $choix_etapes_checked,
        ]);

      }elseif ($table=='devis') {

        //Selection de données nécessaire au formulaire
        $devi                  = devi::with('etat_devi','type_devi','client','chantier','collaborateur')->where('entreprise_id',$entreprise->id)->where('id',$id)->first();
        $chantier_checked      = $this->formulaireRepository->select_chantiers_checked($entreprise,$devi);
        $client_checked        = $this->formulaireRepository->select_clients_checked($entreprise_id,$devi);
        $type_devi_checked     = $this->formulaireRepository->select_type_devis_checked($entreprise_id,$devi);
        $collaborateur_checked = $this->formulaireRepository->select_collaborateurs_checked($entreprise,$devi);
        $progbox_checked       = $this->formulaireRepository->select_progbox_checked($entreprise,$devi);
        $lien                  = '/tableau/'.$entreprise_id.'/'.$table;

        return view($this->chemin_modifier.$table.'_modif2',[
            'titre'          => $entreprise['nom'].' - Modifier un devis',
            'descriptif'     => 'Le devis sera associé à l\'entreprise '.$entreprise['nom_display'].'.',
            'devi'           => $devi,
            'chantiers'      => $chantier_checked,
            'type_devis'     => $type_devi_checked,
            'collaborateurs' => $collaborateur_checked,
            'entreprise'     => $entreprise,
            'clients'        => $client_checked,
            'progbox'        => $progbox_checked,
            'lien'           => $lien,
        ]);

        // return view('test', ['test' =>  $choix_entreprise, 'imputs' => '$a', 'comp' => '$table'.' ']);

      }elseif ($table=='factures') {

        //Selection de données nécessaire au formulaire
        $facture               = facture::with('type_facture','chantier','client','devi','collaborateur')->where('entreprise_id',$entreprise->id)->where('id',$id)->first();
        $chantier_checked      = $this->formulaireRepository->select_chantiers_checked($entreprise,$facture);
        $type_factures_checked = $this->formulaireRepository->select_type_factures_checked($entreprise_id,$facture);
        $collaborateur_checked = $this->formulaireRepository->select_collaborateurs_checked($entreprise,$facture);
        $lien                  = '/tableau/'.$entreprise_id.'/'.$table;

        return view($this->chemin_modifier.$table.'_modif2',[
            'titre'          => $entreprise['nom'].' - Modifier une facture',
            'descriptif'     => 'La facture sera associée à l\'entreprise '.$entreprise['nom_display'].'.',
            'facture'        => $facture,
            'chantiers'      => $chantier_checked,
            'type_factures'  => $type_factures_checked,
            'collaborateurs' => $collaborateur_checked,
            'entreprise'     => $entreprise,
            'lien'           => $lien,
        ]);

        // return view('test', ['test' =>  $choix_entreprise, 'imputs' => '$a', 'comp' => '$table'.' ']);

      }elseif ($table=='reglements') {

        //Selection de données nécessaire au formulaire
        $reglement               = reglement::with('client','facture','type_reglement')->where('entreprise_id',$entreprise->id)->where('id',$id)->first();
        $chantier_checked        = $this->formulaireRepository->select_chantiers_checked($entreprise,$reglement);
        $type_reglements_checked = $this->formulaireRepository->select_type_reglements_checked($entreprise_id,$reglement);
        $client_checked          = $this->formulaireRepository->select_clients_checked($entreprise_id,$reglement);
        $lien                    = '/tableau/'.$entreprise_id.'/'.$table;
        // return view('test', ['test' =>  $type_reglements_checked, 'imputs' => '$a', 'comp' => '$table'.' ']);

        return view($this->chemin_modifier.$table.'_modif2',[
            'titre'           => $entreprise['nom'].' - Modifier un réglement',
            'descriptif'      => 'Le réglement sera associé à l\'entreprise '.$entreprise['nom_display'].'.',
            'reglement'       => $reglement,
            'clients'         => $client_checked,
            'type_reglements' => $type_reglements_checked,
            'entreprise'      => $entreprise,
            'lien'            => $lien,
        ]);

      }
      abort(404);

    }

    //-------------------------
    // Post
    //-------------------------

    public function postModifier($entreprise_id,$table,$id, Request $request)
    {

      $entreprises=entreprise::get();
      $entreprise=entreprise::where('id',$entreprise_id)->first();


      if($table=='devi_facture'){
        //Supprimer les liaisons devis factures
        $supprimer = $this->QueryTableRepository->delete_devi_factureId($id);
        //Sauvergarde des nouvelles les liaisons devis factures
        if(!empty($request->except(['_token']))){

          $ajouter = $this->QueryTableRepository->save_devi_facture($request->except(['_token']),$id);
        }

        // return view('test', ['test' =>  $ajouter , 'imputs' => '$a', 'comp' => $request->except(['_token'])]);
        return redirect('/tableau/'.$entreprise_id.'/factures');

      }elseif($table=='facture_reglement'){
        //Supprimer les liaisons factures reglements
        $supprimer = $this->QueryTableRepository->delete_facture_reglementId($id);
        //Sauvergarde des nouvelles les liaisons factures reglements
        if(!empty($request->except(['_token']))){
          $ajouter = $this->QueryTableRepository->save_facture_reglement($request->except(['_token']),$id);
        }

        // return view('test', ['test' =>  $ajouter , 'imputs' => '$a', 'comp' => $request->except(['_token'])]);
        return redirect('/tableau/'.$entreprise_id.'/reglements');

      }elseif($table=='clients'){

        //Verifier si au moins une entreprise à été selectionner et Préparation de la nouvelle liaison client entreprise
        $liaison_entrepise=$this->TraitementRepository->entreprise_for_client($request->except(['_token']),$id);

        if($liaison_entrepise != false){
          //Suppression de la liaison entreprise existante
          $supprimer = $this->QueryTableRepository->delete_entreprise_clientId($id);
          //Update du client
          $update_client = $this->QueryTableRepository->update_clientId($request->except(['_token']),$id,$entreprises);
          //Ajout de la nouvelle liaison entreprise client
          $save_liaison = $this->QueryTableRepository->save_client_entreprise($liaison_entrepise);

          return redirect('/tableau/'.$entreprise_id.'/clients');
          // return view('test', ['test' =>  $update_client , 'imputs' => '$a', 'comp' => $request->except(['_token'])]);
        }else{
          return redirect('/modifier/'.$entreprise_id.'/clients/'.$id);
        }

        //-------------------------
        // Post - Chantier
        //-------------------------

      }elseif($table=='chantiers'){

        $chantier_actuel = chantier::where('id',$id)->first();
          // return view('test', ['test' =>  $chantier_actuel , 'imputs' => '$a', 'comp' => $request->except(['_token'])]);
        //On test si la possiblité existe de passer à l'autre etape
        $test = possible_etape_chantier::where('etape_chantier_id',$chantier_actuel->etape_chantier_id)->where('possible_id',$request->all()['etape_chantier_id'])->first();
        if(isset($test)){
            $update_chantier = $this->QueryTableRepository->update_chantierId($request->except(['_token']),$id,$entreprises);
            //Gestion des fichiers sur nextcloud
            $data = $this->GD_EDIS->deplacementDossier($chantier_actuel,$entreprise);
          // return view('test', ['test' =>  $data , 'imputs' => '$a', 'comp' => $request->except(['_token'])]);
            return redirect('/tableau/'.$entreprise_id.'/chantiers');
        }else{
            return redirect('/tableau/'.$entreprise_id.'/chantiers');
        }

        //-------------------------
        // Post - Devis
        //-------------------------

      }elseif($table=='devis'){

          $update_devis = $this->QueryTableRepository->update_deviId($request->except(['_token']),$id,$entreprises);

          return redirect('/tableau/'.$entreprise_id.'/devis');

      }elseif($table=='factures'){

        $update_facture = $this->QueryTableRepository->update_factureId($request->except(['_token']),$id,$entreprises);
          // return view('test', ['test' =>  $update_facture , 'imputs' => '$a', 'comp' => $request->except(['_token'])]);

        return redirect('/modifier/'.$entreprise_id.'/devi_facture/'.$id);

      }elseif($table=='reglements'){

        $update_reglement = $this->QueryTableRepository->update_reglementId($request->except(['_token']),$id,$entreprises);
          // return view('test', ['test' =>  $update_facture , 'imputs' => '$a', 'comp' => $request->except(['_token'])]);

        return redirect('/modifier/'.$entreprise_id.'/facture_reglement/'.$id);
          // return redirect('/tableau/'.$entreprise_id.'/devis');

      }
        abort(404);

    }
}
