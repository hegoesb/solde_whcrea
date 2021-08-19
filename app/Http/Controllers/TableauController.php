<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TableauRepository;

use App\Models\chantier;
use App\Models\devi;
use App\Models\facture;
use App\Models\entreprise;
use App\Models\reglement;
use App\Models\type_client;

class TableauController extends Controller
{

    public function __construct(TableauRepository $TableauRepository )
    {
        $this->chemin  = 'pages.tableaux.';
        $this->tableauRepository = $TableauRepository;
    }

    public function viewTable($table)
    {

        $bank = $this->tableauRepository->bank_table($table);

        // return view('test', ['test' =>  $bank, 'imputs' => '$a', 'comp' => '$table'.' ']);


        return view($this->chemin.'banks_datatables',[
            'titre'         => 'EDIS ENR (WHCREA) - Ecritures Bancaire - '.$table,
            'descriptif'    => 'Liste des clients appartenant aux deux entreprises',
            'data'          => $bank,
            'colonne_order' => 2,
            'ordre'         => "desc",
        ]);



        if($table=='clients'){
          $entreprises=entreprise::get();
          $type_clients=type_client::get();
          $data=$this->tableauRepository->selection_clients();
        // return view('test', ['test' =>  $data, 'imputs' => '$a', 'comp' => '$table'.' ']);

          return view($this->chemin.$table.'_datatables',[
              'titre'         => $entreprise['nom'].' - Tableau Client',
              'descriptif'    => 'Liste des clients appartenant aux deux entreprises',
              'data'          => $data,
              'type_clients'  => $type_clients,
              'entreprises'   => $entreprises,
              'entreprise'    => $entreprise,
              'table'         => $table,
              'colonne_order' => 1,
              'ordre'         => "asc",
          ]);
        }elseif($table=='chantiers'){

          $data=$this->tableauRepository->chantier_table($entreprise);
          // return view('test', ['test' =>  $data, 'imputs' => '$a', 'comp' => '$table'.' ']);

          return view($this->chemin.$table.'_datatables',[
              'titre'         => $entreprise['nom'].' - Tableau Chantier',
              'descriptif'    => 'Liste des chantiers appartenant à l\'entreprise '.$entreprise['nom_display'].'.',
              'entreprise'    => $entreprise,
              'table'         => $table,
              'data'          => $data,
              'colonne_order' => 2,
              'ordre'         => "desc",
          ]);
        }elseif($table=='devis'){

          $data=$this->tableauRepository->devi_table($entreprise);
          // return view('test', ['test' =>  $data, 'imputs' => '$a', 'comp' => '$table'.' ']);

          return view($this->chemin.$table.'_datatables',[
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

          return view($this->chemin.$table.'_datatables',[
              'titre'         => $entreprise['nom'].' - Tableau Factures',
              'descriptif'    => 'Liste des factures appartenant à l\'entreprise '.$entreprise['nom_display'].'.',
              'entreprise'    => $entreprise,
              'table'         => $table,
              'data'          => $data,
              'colonne_order' => 1,
              'ordre'         => "desc",
          ]);

        }elseif($table=='reglements'){

          $data=$this->tableauRepository->reglement_table($entreprise);
        // return view('test', ['test' =>  $data, 'imputs' => '$a', 'comp' => '$table'.' ']);

          return view($this->chemin.$table.'_datatables',[
              'titre'         => $entreprise['nom'].' - Tableau Paiements',
              'descriptif'    => 'Liste des reglements appartenant à l\'entreprise '.$entreprise['nom_display'].'.',
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
