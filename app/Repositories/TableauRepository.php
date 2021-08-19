<?php namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

use App\Repositories\ScriptRepository;

use App\Models\chantier;
use App\Models\client;
use App\Models\devi;
use App\Models\devi_facture;
use App\Models\dossier;
use App\Models\facture;
use App\Models\facture_reglement;
use App\Models\reglement;

use App\Models\llx_bank;

class TableauRepository {

	protected $parametre;

	public function __construct(ScriptRepository $ScriptRepository)
	{
      $this->ScriptRepository = $ScriptRepository;
	}

	public function selection_clients()
	{

        $data = client::with('entreprise','type_client')->get();

        return $data;
	}

  //-------------------------
  // Bank
  //-------------------------

  public function bank_table($table)
  {
    if($table == 'toutes'){
      $banks=llx_bank::get();
    }else{
      $banks=llx_bank::whereYear('dateo', '=', $table)->get();
    }

    if(isset($banks[0])){
      foreach ($banks as $key => $bank) {
        $data[$key]['id']    = $bank->rowid;
        $data[$key]['dateo'] = $bank->dateo;
        if($bank->amount<0){
          $data[$key]['debit']  = $bank->amount;
          $data[$key]['credit'] = 0;
        }else{
          $data[$key]['debit']  = 0;
          $data[$key]['credit'] = $bank->amount;
        }
        $data[$key]['label']        = $bank->label;
        $data[$key]['num_releve']   = $bank['num_releve'];
        $data[$key]['depense_par']  = $bank['depense_par'];
        $data[$key]['type_depense'] = $bank['type_depense'];
        $data[$key]['projet']       = $bank['projet'];
      }
    }else{
      $data=null;
    }

    return $data;
  }

  //-------------------------
  // Repartition
  //-------------------------

  public function repartition_table()
  {
    $dates= array(2017,2018,2019,2020,2021);
    $lignes = array('WHCrea','Commun', 'Fabien', 'Remi', 'F+C', 'R+C');
    $recherche[0]['nom'] = 'WHCrea';
    $recherche[0]['initial'] = '';
    $recherche[0]['id'] = 1;
    $recherche[1]['nom'] = 'Commun';
    $recherche[1]['initial'] = 'RF';
    $recherche[1]['id'] = 2;
    $recherche[2]['nom'] = 'Fabien';
    $recherche[2]['initial'] = 'F';
    $recherche[2]['id'] = 3;
    $recherche[3]['nom'] = 'Remi';
    $recherche[3]['initial'] = 'R';
    $recherche[3]['id'] = 4;



    foreach ($dates as $key_d => $date) {
      foreach ($recherche as $key_r => $r) {
        $data[$r['nom']]['id'][0]=$r['id'];
        $data[$r['nom']]['nom'][0]=$r['nom'];
        if ($r['nom']=='WHCrea') {
         $data[$r['nom']][$date][0]=round(llx_bank::whereYear('dateo', '=', $date)->sum('amount'),2);

        }elseif ($r['nom']=='Commun') {
         $data[$r['nom']][$date][0]=round(llx_bank::whereYear('dateo', '=', $date)->where('depense_par',$r['initial'])->sum('amount'),2);
          if ($r['nom']!='Commun') {
            $data[$date][$r['nom'].' + Commun'][0]=$data[$date][$r['nom']]+($data[$date]['Commun']/2);
          }
        }elseif ($r['nom']=='Fabien') {
         $data[$r['nom']][$date][0]=round(llx_bank::whereYear('dateo', '=', $date)->where('depense_par',$r['initial'])->sum('amount'),2);
         $data['F+C']['nom'][0]='F+C';
         $data['F+C']['id'][0]=7;
         $data['F+C'][$date][0]=$data[$r['nom']][$date][0]+($data['Commun'][$date][0]/2);
        }elseif ($r['nom']=='Remi') {
         $data[$r['nom']][$date][0]=round(llx_bank::whereYear('dateo', '=', $date)->where('depense_par',$r['initial'])->sum('amount'),2);
         $data['R+C']['nom'][0]='R+C';
         $data['R+C']['id'][0]=8;
         $data['R+C'][$date][0]=$data[$r['nom']][$date][0]+($data['Commun'][$date][0]/2);
        }
      }

    }

    // TVA Récupéré

    $tva_r_2017 = -round(llx_bank::whereYear('dateo', '=', 2017)->where('type_depense','Magie+Bière')->sum('amount')/1.2*0.2,2);
    $tva_r_2018 = -round(llx_bank::whereYear('dateo', '=', 2018)->where('type_depense','Magie+Bière')->sum('amount')/1.2*0.2,2);
    $tva_recup_2019 = round(llx_bank::where('rowid',762)->sum('amount'),2);
    $tva_f_2020 = -round(llx_bank::whereYear('dateo', '=', 2020)->where('depense_par','F')->where('type_depense','Informatique-Téléphone')->sum('amount')/1.2*0.2,2);
    $tva_r_2020 = round(llx_bank::whereYear('dateo', '=', 2020)->where('type_depense','TVA')->sum('amount'),2);
    $tva_r_2020_12 = -round(llx_bank::whereYear('dateo', '=', 2020)->whereMonth('dateo', '=', 12)->where('type_depense','Brasserie')->sum('amount')/1.2*0.2,2);
    $tva_r_2021 = -round(llx_bank::whereYear('dateo', '=', 2021)->where('depense_par','R')->where('type_depense','Brasserie')->sum('amount')/1.2*0.2,2);
    $tva_f_2021 = -round(llx_bank::whereYear('dateo', '=', 2021)->where('depense_par','F')->where('type_depense','!=', 'Compte Associé')->sum('amount')/1.2*0.2,2);

    //Remi


    $data['TVA_R']['nom'][0]='TVA Remi';
    $data['TVA_R']['id'][0]=6;
    $data['TVA_R'][2017][0]=0;
    $data['TVA_R'][2017][1]='Pas de TVA récuperée';
    $data['TVA_R'][2018][0]=0;
    $data['TVA_R'][2018][1]='Pas de TVA récuperée';
    $data['TVA_R'][2019][0]=$tva_r_2017+$tva_r_2018;
    $data['TVA_R'][2019][1]='TVA de 2017 et 2018';
    $data['TVA_R'][2020][0]=$tva_r_2020-$tva_f_2020;
    $data['TVA_R'][2020][1]='TVA 2020 recup ='.$tva_r_2020.'€ - TVA Fabien';
    $data['TVA_R'][2021][0]=$tva_r_2021+$tva_r_2020_12+$tva_f_2021;
    $data['TVA_R'][2021][1]='TVA Non Pris En compte : 2020_12 ('.$tva_r_2020_12.'€) + 2021 ('.$tva_r_2021.'€) - TVA Fabien='.$data['TVA_R'][2021][0].'€';

    $data['R+C'][2019][0]=$data['R+C'][2019][0]+$data['TVA_R'][2019][0];
    $data['Remi'][2019][0]=$data['Remi'][2019][0]+$data['TVA_R'][2019][0];
    $data['R+C'][2020][0]=$data['R+C'][2020][0]-$tva_f_2020;
    $data['Remi'][2020][0]=$data['Remi'][2020][0]-$tva_f_2020;
    //Fabien

    $data['TVA_F']['nom'][0]='TVA Fabien';
    $data['TVA_F']['id'][0]=5;
    $data['TVA_F'][2017][0]=0;
    $data['TVA_F'][2017][1]='Pas de TVA récuperée';
    $data['TVA_F'][2018][0]=0;
    $data['TVA_F'][2018][1]='Pas de TVA récuperée';
    $data['TVA_F'][2019][0]=$tva_recup_2019-$data['TVA_R'][2019][0];
    $data['TVA_F'][2019][1]='TVA de 2017 et 2018 ='.$tva_recup_2019.'€ - TVA Remi';
    $data['TVA_F'][2020][0]=$tva_f_2020;
    $data['TVA_F'][2020][1]='TVA -> INFORMATIQUE ET TELEPHONE';
    $data['TVA_F'][2021][0]=$tva_f_2021;
    $data['TVA_F'][2021][1]='TVA -> INFORMATIQUE ET TELEPHONE + Culture Comptable';

    $data['F+C'][2019][0]=$data['F+C'][2019][0]-$data['TVA_R'][2019][0];
    $data['Fabien'][2019][0]=$data['Fabien'][2019][0]-$data['TVA_R'][2019][0];
    $data['F+C'][2020][0]=$data['F+C'][2020][0]+$tva_f_2020;
    $data['Fabien'][2020][0]=$data['Fabien'][2020][0]+$tva_f_2020;
    $data['F+C'][2021][0]=$data['F+C'][2021][0]+$tva_f_2021;
    $data['Fabien'][2021][0]=$data['Fabien'][2021][0]+$tva_f_2021;

    foreach ($data as $key_da => $da) {
        $data[$key_da]['total'][0]=0;
      foreach ($dates as $key_d => $date) {
        $data[$key_da]['total'][0]=$data[$key_da]['total'][0]+$da[$date][0];
      }
    }





    return $data;
  }

  //-------------------------
  // Chantier
  //-------------------------

  public function solde_table($data)
  {

    //fabien

    $solde['Fabien']['nom']='Fabien';
    $solde['Fabien']['Solde'][0]=round($data['F+C']['total'][0],2);
    $solde['Fabien']['Solde'][1]='Solde au 14 Août 2021';
    $solde['Fabien']['Solde'][2]='media/svg/icons/Home/Home.svg';
    $solde['Fabien']['Dépense'][1][0]=-675.00;
    $solde['Fabien']['Dépense'][1][1]='Loyer Trimestre 2 - 2020 (HT)';
    $solde['Fabien']['Dépense'][1][2]='media/svg/icons/Home/Wood-horse.svg';
    $solde['Fabien']['Dépense'][2][0]=-675.00;
    $solde['Fabien']['Dépense'][2][1]='Loyer Trimestre 3 - 2020 (HT)';
    $solde['Fabien']['Dépense'][2][2]='media/svg/icons/Home/Wood-horse.svg';
    $solde['Fabien']['Dépense'][3][0]=-675.00;
    $solde['Fabien']['Dépense'][3][1]='Loyer Trimestre 4 - 2020 (HT)';
    $solde['Fabien']['Dépense'][3][2]='media/svg/icons/Home/Wood-horse.svg';
    $solde['Fabien']['Dépense'][4][0]=-675.00;
    $solde['Fabien']['Dépense'][4][1]='Loyer Trimestre 1 - 2021 (HT)';
    $solde['Fabien']['Dépense'][4][2]='media/svg/icons/Home/Wood-horse.svg';
    $solde['Fabien']['Dépense'][5][0]=-450/2;
    $solde['Fabien']['Dépense'][5][1]='Facture culture comptable - 450€ (HT) - Commun';
    $solde['Fabien']['Dépense'][5][2]='media/svg/icons/Home/Wood-horse.svg';

    //remi

    $solde['Remi']['nom']='Remi';
    $solde['Remi']['Solde'][0]=round($data['R+C']['total'][0],2);
    $solde['Remi']['Solde'][1]='Solde au 14 Août 2021';
    $solde['Remi']['Solde'][2]='media/svg/icons/Home/Home.svg';
    $solde['Remi']['Dépense'][1][0]=3750.00;
    $solde['Remi']['Dépense'][1][1]='Depôt de garantie (HT)';
    $solde['Remi']['Dépense'][1][2]='media/svg/icons/Food/Carrot.svg';
    $solde['Remi']['Dépense'][2][0]=-2942.00;
    $solde['Remi']['Dépense'][2][1]='TVA à payer régule Brasserie';
    $solde['Remi']['Dépense'][2][2]='media/svg/icons/Home/Wood-horse.svg';
    $solde['Remi']['Dépense'][3][0]=-450/2;
    $solde['Remi']['Dépense'][3][1]='Facture culture comptable - 450€ (HT) - Commun';
    $solde['Remi']['Dépense'][3][2]='media/svg/icons/Home/Wood-horse.svg';

    foreach ($solde as $key_s => $noms) {
      $solde[$key_s]['Solde_F'][0]=$solde[$key_s]['Solde'][0];
      foreach ($noms['Dépense'] as $key_n => $value) {
          $solde[$key_s]['Solde_F'][0]=round($solde[$key_s]['Solde_F'][0]+$value[0],2);
      }
    }



    return $solde;
  }

  //-------------------------
  // Devis
  //-------------------------

  public function devi_table($entreprise)
  {
    $devis   = devi::with('etat_devi','type_devi','client','chantier','collaborateur')->where('entreprise_id',$entreprise->id)->get();
    if(isset($devis[0])){
      foreach ($devis as $key => $devi) {
        $data[$key]['id']                       = $devi->id;
        $data[$key]['lot']                      = $devi->lot;
        $data[$key]['numero']                   = $devi->numero;
        $data[$key]['chantier']['identifiant']  = $devi['chantier']->identifiant;
        $data[$key]['chantier']['nom']          = $devi['chantier']->nom;
        $data[$key]['collaborateur']['nom_display']  = $devi['collaborateur']->nom_display;
        $data[$key]['collaborateur']['nom']          = $devi['collaborateur']->nom;
        $data[$key]['client']['nom']            = $devi['client']->nom;
        $data[$key]['client']['nom_display']    = $devi['client']->nom_display;
        $data[$key]['type_devi']['nom']         = $devi['type_devi']['nom'];
        $data[$key]['type_devi']['nom_display'] = $devi['type_devi']['nom_display'];
        $data[$key]['etat_devi']['nom']         = $devi['etat_devi']['nom'];
        $data[$key]['etat_devi']['nom_display'] = $devi['etat_devi']['nom_display'];
        $data[$key]['envoie']                   = $devi->IfNull['envoie'];
        $data[$key]['signature']                = $devi->IfNull['signature'];
        $data[$key]['progbox']                  = $devi->IfNull['progbox'];
        $data[$key]['total_ht']                 = $devi->total_ht;
        $data[$key]['total_ttc']                = $devi->total_ttc;
        $data[$key]['tva']                      = $devi->tva;

        $facture = devi_facture::where('devi_id',$devi->id)->first();
        if(!isset($facture)){
          $data[$key]['supprimer']='/supprimer/'.$entreprise->id.'/devis/'.$devi->id;
        }else{
          $data[$key]['supprimer']=null;
        }

        //Recherche devis sauvergardé
        $dossier = dossier::where('numero',222)->first();
        $recherche_fichier= $this->ScriptRepository->findNextcloud($entreprise->prefixe_dossier."_".$dossier->numero."_".$dossier->libelle,$devi->numero.'.pdf');
        if(!empty($recherche_fichier[0])){
          $data[$key]['devis_sauvegarder'] = 1;
        }else{
          $data[$key]['devis_sauvegarder'] = 0;
        }

        //Recherche des devis signé sauvergardés
        $dossier = dossier::where('numero',223)->first();
        $recherche_fichier= $this->ScriptRepository->findNextcloud($entreprise->prefixe_dossier."_".$dossier->numero."_".$dossier->libelle,$devi->numero.'-S.pdf');
        if(!empty($recherche_fichier[0])){
          $data[$key]['devis_signer_sauvegarder'] = 1;
        }else{
          $data[$key]['devis_signer_sauvegarder'] = 0;
        }
        //Recherche des contats sauvergardés
        $dossier = dossier::where('numero',224)->first();
        $recherche_fichier= $this->ScriptRepository->findNextcloud($entreprise->prefixe_dossier."_".$dossier->numero."_".$dossier->libelle,$devi->numero.'-C.pdf');
        if(!empty($recherche_fichier[0])){
          $data[$key]['contrat_sauvegarder'] = 1;
        }else{
          $data[$key]['contrat_sauvegarder'] = 0;
        }

      }
    }else{
      $data=null;
    }

    return $data;
  }

  //-------------------------
  // Facture
  //-------------------------

  public function facture_table($entreprise)
  {

    $factures=facture::with('devi','type_facture','client','chantier','collaborateur')->where('entreprise_id',$entreprise->id)->get();

    if(isset($factures[0])){
      foreach ($factures as $key => $facture) {
        $data[$key]['id']                           = $facture->id;
        $data[$key]['numero']                       = $facture->numero;
        $data[$key]['chantier']['identifiant']      = $facture['chantier']->identifiant;
        $data[$key]['chantier']['nom']              = $facture['chantier']->nom;
        $data[$key]['collaborateur']['nom_display'] = $facture['collaborateur']->nom_display;
        $data[$key]['collaborateur']['nom']         = $facture['collaborateur']->nom;
        $data[$key]['client']['nom']                = $facture['client']->nom;
        $data[$key]['client']['nom_display']        = $facture['client']->nom_display;
        $data[$key]['type_facture']['nom']          = $facture['type_facture']['nom'];
        $data[$key]['type_facture']['nom_display']  = $facture['type_facture']['nom_display'];
        $data[$key]['devi']                         = $facture['devi'];
        $data[$key]['date_creation']                = $facture->date_creation;
        $data[$key]['date_echeance']                = $facture->date_echeance;
        $data[$key]['date_envoie']                  = $facture->date_envoie;
        $data[$key]['total_ht']                     = $facture->total_ht;
        $data[$key]['total_ttc']                    = $facture->total_ttc;
        $data[$key]['tva']                          = $facture->tva;
        $data[$key]['retenuegarantie_ht']           = $facture->retenuegarantie_ht;

        $reglement = facture_reglement::where('facture_id',$facture->id)->first();
        if(!isset($reglement)){
          $data[$key]['supprimer']='/supprimer/'.$entreprise->id.'/factures/'.$facture->id;
        }else{
          $data[$key]['supprimer']=null;
        }

        //Recherche factures sauvergardés
        $dossier = dossier::where('numero',220)->first();
        $recherche_fichier= $this->ScriptRepository->findNextcloud($entreprise->prefixe_dossier."_".$dossier->numero."_".$dossier->libelle,$facture->numero.'.pdf');
        if(!empty($recherche_fichier[0])){
          $data[$key]['facture_sauvegarder'] = 1;
        }else{
          $data[$key]['facture_sauvegarder'] = 0;
        }

        //Recherche situations sauvergardés
        $dossier = dossier::where('numero',221)->first();
        $recherche_fichier= $this->ScriptRepository->findNextcloud($entreprise->prefixe_dossier."_".$dossier->numero."_".$dossier->libelle,$facture->numero.'-S.pdf');
        if(!empty($recherche_fichier[0])){
          $data[$key]['situation_sauvegarder'] = 1;
        }else{
          $data[$key]['situation_sauvegarder'] = 0;
        }



      }
    }else{
      $data=null;
    }
    return $data;
  }

  //-------------------------
  // Reglement
  //-------------------------

  public function reglement_table($entreprise)
  {

    $reglements=reglement::with('type_reglement','client','facture')->where('entreprise_id',$entreprise->id)->get();

    if(isset($reglements[0])){
      foreach ($reglements as $key => $reglement) {
        $data[$key]['id']                            = $reglement->id;
        $data[$key]['numero_releve_compte']          = $reglement->numero_releve_compte;
        // $data[$key]['chantier']['identifiant']    = $reglement['chantier']->identifiant;
        // $data[$key]['chantier']['nom']            = $reglement['chantier']->nom;
        $data[$key]['client']['nom']                 = $reglement['client']->nom;
        $data[$key]['client']['nom_display']         = $reglement['client']->nom_display;
        $data[$key]['type_reglement']['nom']         = $reglement['type_reglement']['nom'];
        $data[$key]['type_reglement']['nom_display'] = $reglement['type_reglement']['nom_display'];
        $data[$key]['date_paye']                     = $reglement->date_paye;
        $data[$key]['valeur_ttc']                    = $reglement->valeur_ttc;

        $data[$key]['supprimer']='/supprimer/'.$entreprise->id.'/reglements/'.$reglement->id;
      }
    }else{
      $data=null;
    }
    return $data;
  }

}
