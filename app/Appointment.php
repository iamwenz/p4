<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function user() {
      # User belongs to Appointment
      # Define an inverse one-to-many relationship
      return $this->belongsTo('App\User');
    }

    public function veterinarians() {
      # withTimestamps will ensure the pivot table has its created_at/updated_at fields automatically maintained
      return $this->belongsToMany('App\Veterinarian')->withTimestamps();
    }
}
