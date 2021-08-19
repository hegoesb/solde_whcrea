<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class facture extends Model
{
    use HasFactory;
  use SoftDeletes;

  public function type_facture()
  {
      return $this->belongsTo('App\Models\type_facture');
  }
  public function chantier()
  {
      return $this->belongsTo('App\Models\chantier');
  }
  public function client()
  {
      return $this->belongsTo('App\Models\client');
  }
  public function collaborateur()
  {
      return $this->belongsTo('App\Models\collaborateur');
  }
  public function devi()
  {
      return $this->belongsToMany('App\Models\devi');
  }

}
