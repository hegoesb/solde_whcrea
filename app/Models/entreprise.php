<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class entreprise extends Model
{
  use HasFactory;
  protected $table = 'entreprises';

  public function client()
  {
      return $this->belongsToMany('App\Models\client');
  }
}
