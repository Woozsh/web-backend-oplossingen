<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id', 'body', 'score'];

    public function post()
    {
      return $this->belongsTo('App\Post');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function replies()
    {
      return $this->hasMany('App\Reply');
    }

    public function addReply(Reply $reply)
    {
      return $this->replies()->save($reply);
    }
}
