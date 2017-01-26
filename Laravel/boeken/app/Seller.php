<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = ['name', 'surname', 'email', 'phone'];

    public function books()
    {
      return $this->hasMany('App\Book');
    }
    public function addBook(Book $book)
    {
      return $this->books()->save($book);
    }
}
