<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;
use DB;

class CommentsController extends Controller
{
    public function delete(Comment $comment)
    {
      $comment->delete();

      return redirect('/posts/' . $comment->post->id);
    }

    //edit
      public function edit(Comment $comment)
      {
        $post = $comment->post;
        $comments = $post->comments;
        if (Auth::check() && $comment->user->name == Auth::user()->name) {
          return view('posts.editComment', compact('post', 'comments','comment'));
        }else{
          return back();
        }
      }

      public function update(Request $request, Comment $comment)
      {
        $comment->update($request->All());

        return redirect('/posts/' . $comment->post->id);
      }


    public function upvote(Comment $comment)
    {
      $voted = DB::table('votes')->where([
        ['user_id', Auth::user()->id],
        ['comment_id', $comment->id]
      ])->get()->first();

        if ($voted && $voted->vote == "downvote")
        {
          DB::table('votes')
            ->where('id', $voted->id)
            ->update(['vote' => 'upvote']);

          $comment->update(['score' => ($comment->score + 2)]);
        }
        elseif($voted)
        {
          DB::table('votes')
            ->where('id', $voted->id)
            ->delete();

          $comment->update(['score' => ($comment->score -1)]);
        }
        else
        {
          DB::table('votes')->insert(
              ['user_id' => Auth::user()->id,
              'comment_id' => $comment->id,
              'vote' => 'upvote']);

          $comment->update(['score' => ($comment->score + 1)]);
        }

      return back();
    }
    public function downvote(Comment $comment)
    {
      $voted = DB::table('votes')->where([
        ['user_id', Auth::user()->id],
        ['comment_id', $comment->id]
      ])->get()->first();

        if ($voted && $voted->vote == "upvote")
        {
          DB::table('votes')
            ->where('id', $voted->id)
            ->update(['vote' => 'downvote']);

          $comment->update(['score' => ($comment->score - 2)]);
        }
        elseif($voted)
        {
          DB::table('votes')
            ->where('id', $voted->id)
            ->delete();

          $comment->update(['score' => ($comment->score + 1)]);
        }
        else
        {
          DB::table('votes')->insert(
              ['user_id' => Auth::user()->id,
              'comment_id' => $comment->id,
              'vote' => 'downvote']);

          $comment->update(['score' => ($comment->score - 1)]);
        }

      return back();
    }
}
