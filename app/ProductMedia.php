<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    protected $fillable = [
        'menu_id', 'product_detail_id', 'media_1',
        'media_2', 'media_3', 'media_4', 'media_5'
    ];

    public function product() {
      return $this->belongsTo('App\ProductDetail', 'product_detail_id');
    }

    public function menu() {
      return $this->belongsTo('App\Menu');
    }
}
