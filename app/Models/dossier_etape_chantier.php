<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dossier_etape_chantier extends Model
{
    use HasFactory;
  protected $table = 'dossier_etape_chantiers';

  public function dossier()
  {
      return $this->belongsTo('App\Models\dossier');
  }
  public function etape_chantier()
  {
      return $this->belongsTo('App\Models\etape_chantier');
  }


}
