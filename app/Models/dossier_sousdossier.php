<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dossier_sousdossier extends Model
{
    use HasFactory;

  protected $table = 'dossier_sousdossier';

  public function dossier()
  {
      return $this->belongsTo('App\Models\dossier');
  }
  public function sousdossier()
  {
      return $this->belongsTo('App\Models\sousdossier');
  }
}
