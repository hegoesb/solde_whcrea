<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;


use App\Models\entreprise;
use App\Models\type_document;

class UploadController extends Controller
{
    public function __construct()
    {
      $this->chemin_upload = 'pages.upload.';
    }

  //-------------------------
  // View
  //-------------------------


    public function viewUpload($entreprise_id,$table,$devis_id)
    {
      $entreprise    = entreprise::where('id',$entreprise_id)->first();
      $type_documents = type_document::where('nom','DE')->orWhere('nom','CT')->get();
      foreach ($type_documents as $key_2 => $value) {
        $data[$key_2][0]=$value['id'];
        $data[$key_2][1]=$value['nom_display'];
      }

      return view($this->chemin_upload.$table.'_upload2',[
          'titre'          => $entreprise['nom'].' - Télécharger un devis signé ou un contrat signé',
          'descriptif'     => 'Le client sera ajouté à la table client commune aux deux entreprises. Un client peut appartenir aux deux entreprises',
          // 'type_client' => $type_client,
          'type_documents' => $data,
          'entreprise_id'  => $entreprise->id,
          'devis_id'       => $devis_id,
      ]);
    }

  //-------------------------
  // Post
  //-------------------------

    public function postUpload($entreprise_id, $table, Request $request)
    {

      $entreprise    = entreprise::where('id',$entreprise_id)->first();
      $type_document = type_document::where('nom','DE')->orWhere('nom','CT')->get();

      if($table=='devis'){
        $this->validate($request, [
            'type_document_id' => 'required',
            'fichier' => 'required|file|mimes:pdf',
        ]);

        if($request->has('fichier')){
        return view('test', ['test' => 'oui', 'imputs' => '$a', 'comp' => $request->except(['_token'])]);

        }else{
          return redirect()->back();
        }

        return view('test', ['test' => 'non', 'imputs' => '$a', 'comp' => $request->except(['_token'])]);

      }
    }


}
