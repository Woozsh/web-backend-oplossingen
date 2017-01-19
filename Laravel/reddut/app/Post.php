<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = ['title', 'link', 'body', 'score'];

  public function comments()
  {
    return $this->hasMany('App\Comment');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function replies()
  {
    return $this->hasMany('App\Reply');
  }

  public function addComment(Comment $comment)
  {
    return $this->comments()->save($comment);
  }
}
