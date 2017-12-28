<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'maincategory_id', 'name', 'intro'
    ];

    public function maincategory() {
      return $this->belongsTo('App\Maincategory');
    }
}
