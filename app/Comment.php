<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'product_id', 'is_active', 'author', 'body'
    ];

    public function product() {
      return $this->belongsTo('App\Product');
    }

    public function user() {
      return $this->belongsTo('App\User', 'author');
    }

    public function replies(){
      return $this->hasMany('App\CommentReply');
    }

}
