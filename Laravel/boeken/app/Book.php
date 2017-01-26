<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  protected $fillable = ['title', 'author', 'newprice', 'price', 'comment'];
    public function seller()
    {
      return $this->belongsTo('App\Seller');
    }
}
