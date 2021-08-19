<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class client extends Model
{
  use HasFactory;
  use SoftDeletes;

  public function entreprise()
  {
      return $this->belongsToMany('App\Models\entreprise', 'client_entreprise', 'client_id', 'entreprise_id');
  }
  public function type_client()
  {
      return $this->belongsTo('App\Models\type_client');
  }


}
