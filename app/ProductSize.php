<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $fillable = [
      'name', 'menu_id'
    ];

    public function menu() {
      return $this->belongsTo('App\Menu');
    }
}
