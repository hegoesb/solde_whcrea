<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class reglement extends Model
{
    use HasFactory;
  use SoftDeletes;

  public function client()
  {
      return $this->belongsTo('App\Models\client');
  }
  public function facture()
  {
      return $this->belongsToMany('App\Models\facture', 'facture_reglement', 'facture_id', 'reglement_id');
  }
  public function type_reglement()
  {
      return $this->belongsTo('App\Models\type_reglement');
  }

}
