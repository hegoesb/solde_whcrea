<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dossier extends Model
{
    use HasFactory;

  public function etape_chantier()
  {
      return $this->belongsToMany('App\Models\etape_chantier', 'dossier_etape_chantier', 'etape_chantier_id', 'dossier_id');
  }

}
