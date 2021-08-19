<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\TableauRepository;

use App\Models\entreprise;


class DocumentController extends Controller
{
public function __construct(TableauRepository $TableauRepository )
    {
        $this->chemin_document  = 'pages.documents.';
        $this->tableauRepository = $TableauRepository;
    }

    public function viewTable($entreprise_id,$table)
    {

        $entreprise=entreprise::where('id',$entreprise_id)->first();

        if($table=='devis'){

          $data=$this->tableauRepository->devi_table($entreprise);
          // return view('test', ['test' =>  $data, 'imputs' => '$a', 'comp' => '$table'.' ']);

          return view($this->chemin_document.$table.'_datatables',[
              'titre'         => $entreprise['nom'].' - Tableau Devis',
              'descriptif'    => 'Liste des devis appartenant à l\'entreprise '.$entreprise['nom_display'].'.',
              'entreprise'    => $entreprise,
              'table'         => $table,
              'data'          => $data,
              'colonne_order' => 1,
              'ordre'         => "desc",
          ]);
        }elseif($table=='factures'){

          $data=$this->tableauRepository->facture_table($entreprise);
        // return view('test', ['test' =>  $data, 'imputs' => '$a', 'comp' => '$table'.' ']);

          return view($this->chemin_document.$table.'_datatables',[
              'titre'         => $entreprise['nom'].' - Tableau Factures',
              'descriptif'    => 'Liste des factures appartenant à l\'entreprise '.$entreprise['nom_display'].'.',
              'entreprise'    => $entreprise,
              'table'         => $table,
              'data'          => $data,
              'colonne_order' => 1,
              'ordre'         => "desc",
          ]);

        }

        abort(404);

    }
}
