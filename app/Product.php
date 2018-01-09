<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'menu_id', 'name', 'manufactor_id', 'sales', 'collects'
    ];

    public function menu() {
      return $this->belongsTo('App\Menu');
    }

    public function manufactor() {
      return $this->belongsTo('App\Manufactor');
    }

}
