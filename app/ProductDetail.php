<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $fillable = [
        'name', 'menu_id', 'product_id', 'product_color_id',
        'product_material_id', 'product_size_id', 'price'
    ];

    public function product() {
      return $this->belongsTo('App\Product');
    }

    public function menu() {
      return $this->belongsTo('App\Menu');
    }

    public function color() {
      return $this->belongsTo('App\ProductColor', 'product_color_id');
    }

    public function size() {
      return $this->belongsTo('App\ProductSize', 'product_size_id');
    }

    public function material() {
      return $this->belongsTo('App\ProductMaterial', 'product_material_id');
    }
}
