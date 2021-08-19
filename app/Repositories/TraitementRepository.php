<?php namespace App\Repositories;

use App\Models\bigramme;
use App\Models\chantier;
use App\Models\entreprise;

use Carbon\Carbon;

class TraitementRepository {

	protected $parametre;

	public function __construct()
	{

	}
  //-------------------------
  // Entreprise
  //-------------------------

  public function entreprise_for_client($request,$client_id)
  {

    $entreprises=entreprise::get();
    $data = false;

    foreach ($entreprises as $key_entreprise => $entreprise) {
      foreach ($request as $key_resquest => $value) {
        if('entreprise_'.$entreprise->id==$key_resquest){
          $data[$key_entreprise][0]=$entreprise->id;
          $data[$key_entreprise][1]=$client_id;
        }
      }
    }
    return $data;
  }

  //-------------------------
  // Chantier
  //-------------------------

  public function new_identifiant_chantier($entreprise)
  {
    $date = Carbon::now();
    $chantier = chantier::where('entreprise_id',$entreprise->id)->orderBy('identifiant', 'desc')->first();

    if(isset($chantier)){
      $numero_chantier = str_split($chantier->identifiant,11)[1]+1;
      $array_numero = str_split($numero_chantier,1);
      $i=0;
      foreach ($array_numero as $key => $value) {
        $i++;
      }
      if($i==3){
        $numero = '000'.$numero_chantier;
      }elseif($i==2){
        $numero = '00'.$numero_chantier;
      }elseif($i==1){
        $numero = '0'.$numero_chantier;
      }
      // $numero = str_split($last_numero_chantier,1);
      $identifiant = $entreprise->prefixe_chantier.$date->format('ym').'-'.$numero;
    }else{
      $identifiant = $entreprise->prefixe_chantier.$date->format('ym').'-0001';
    }

    return $identifiant;
  }


  //-------------------------
  // Tri Version plan
  //-------------------------

  public function triVersionPlan($liste_plans)
  {

    foreach ($liste_plans as $key_lp => $lp) {//Bloucle liste plan

      $explode_nom_plan        = explode("_", $lp);
      if(isset($explode_nom_plan[3])){
        $explode_nom_plan['array_id']  = $key_lp;
        $explode_nom_plan['nom_plan']  = $explode_nom_plan[2];
        $explode_version               = str_split($explode_nom_plan[3]);
        $explode_nom_plan['diffusion'] = array_shift($explode_version);
        $version_travail               = array_shift($explode_version);
        if(empty($explode_version)){
          $explode_nom_plan['travail'] = false;

        }else{
          $explode_nom_plan['travail'] = implode($explode_version);

        }
        $array[$key_lp] = $explode_nom_plan;

      }
    }

    //Contrôle si le nom du fichier est formaté
    foreach ($array as $key_a => $plan_courant) {
      if($this->controleNomFichierFormat($plan_courant)==true){
        unset($array[$key_a]);
      }
    }

    //Tri par version
    $nom_plan = array_column($array, 'nom_plan');
    $diffusion = array_column($array, 'diffusion');
    $travail   = array_column($array, 'travail');
    array_multisort($nom_plan, SORT_ASC, $diffusion, SORT_DESC, $travail, SORT_DESC, $array);

    $plan_reference = $array[0];
    $key_reference  = 0;
    $plan_a_diffuser = 1;
    foreach ($array as $key_a => $plan_courant) {

      if($plan_reference['nom_plan'] == $plan_courant['nom_plan']){
        if($plan_courant['travail']==false){
          if($plan_a_diffuser==1){// Si version de diffusion existe
            $array[$key_a]['deplacer']=false;
            $plan_a_diffuser = 0;
          }else{
            $array[$key_a]['deplacer']=true;
          }
        }else{
          if($plan_reference['diffusion']==$plan_courant['diffusion']){ //On garde les versions travail de la futur version de diffusion
            $array[$key_a]['deplacer']=false;
          }else{
            $array[$key_a]['deplacer']=true;
          }
        }
      }else{
        $plan_reference  = $plan_courant;
        $key_reference   = $key_a;
        $plan_a_diffuser = 1;
        if($plan_reference['travail']==0){
          if($plan_a_diffuser==1){// Si version de diffusion existe
            $array[$key_a]['deplacer']=false;
            $plan_a_diffuser = 0;
          }else{
            $array[$key_a]['deplacer']=true;
          }
        }else{
          if($plan_reference['diffusion']==$plan_courant['diffusion']){ //On garde les versions travail de la futur version de diffusion
            $array[$key_a]['deplacer']=false;
          }else{
            $array[$key_a]['deplacer']=true;
          }
        }

      }
    }

    return $array;
  }

  //-------------------------
  // Controle intégrité du format du nom fichier
  //-------------------------

  public function controleNomFichierFormat($plan_courant){

    $verif_projet = chantier::where('identifiant',$plan_courant[0].'_'.$plan_courant[1])->first();
    if(!empty($verif_projet)){
      $bigramme = str_split($plan_courant[2],3);
      $verif_birgamme = bigramme::where('nom',$bigramme[0])->first();
      if(!empty($verif_birgamme)){
        return false;
      }
      return true;
    }else{
      return true;
    }
  }

  //-------------------------
  // Echappement Caractère Linux
  //-------------------------

  public function echapeCaractereLinux($data){
    $data = str_replace(" ","\ ",$data);
    $data = str_replace("&","\&",$data);
    $data = str_replace("(","\(",$data);
    $data = str_replace(")","\)",$data);
    $data = str_replace("$","\$",$data);
    $data = str_replace("!","\!",$data);
    $data = str_replace(":","\:",$data);
    $data = str_replace("*","\*",$data);
    return $data;
  }

}


