<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufactor extends Model
{
    protected $fillable = [
        'name', 'country_id', 'city_id', 'address', 'phone', 'logo'
    ];

    public function country() {
      return $this->belongsTo('App\Country');
    }

    public function city() {
      return $this->belongsTo('App\City');
    }
}
