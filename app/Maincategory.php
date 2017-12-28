<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maincategory extends Model
{
    protected $fillable = [
        'menu_id', 'name', 'intro', 'icon'
    ];

    public function menu() {
      return $this->belongsTo('App\Menu');
    }

    public function subcategories() {
      return $this->hasMany('App\Subcategory');
    }
}
