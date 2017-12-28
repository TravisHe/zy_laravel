<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name', 'intro'
    ];

    public function maincategories() {
      return $this->hasMany('App\Maincategory');
    }

}
