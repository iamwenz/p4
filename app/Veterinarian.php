<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veterinarian extends Model
{
  public function appointments()
  {
    # withTimestamps will ensure the pivot table has its created_at/updated_at fields automatically maintained
    return $this->belongsToMany('App\Appointment')->withTimestamps();
  }
}
