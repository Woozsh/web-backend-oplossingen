@extends('layout')

@section('navbar')
  <a class="navbar-brand" href="{{ url('/posts') }}">Terug naar Posts</a>

@endsection
@section('content')

{{-- POST --}}

  <h2>{{ $post->title }}</h2>
  <i>{{ $post->user->name }}</i>

  <hr>
  <div class="well well-lg post">
    <div class="row">
      <div class="col-md-2 flex-center">
        @include('../partials/votes', ['id' => $post->id, 'score' => $post->score, 'name' => 'posts'])
      </div>
      <div class="col-md-9">
        <p>{{ $post->body }}</p>
      </div>
      <div class="col-md-1">
      @if (Auth::user()->isAdmin || Auth::check() && $comment->user->name == Auth::user()->name)
          <form action="{{ url('/posts/' . $post->id . '/edit') }}" method="post">
            {{ csrf_field() }}

              <button type="submit" name="button" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-edit"></i></button>
          </form><br>
          <form action="{{ url('/posts/' . $post->id)}}" method="post">
            {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">

              <button type="submit" name="button" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>
          </form>
      @endif
      </div>
    </div>
  </div>
  <hr>



{{-- EDIT COMMENT --}}

  @if (Auth::user()->isAdmin || Auth::check() && $comment->user->name == Auth::user()->name)
    <h3>Pas je comment aan:</h3>
    @if (count($errors))
      <div class="alert alert-warning alert-dismissable fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error}}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form class="form-horizontal" action="{{url('/comments' . '/'. $comment->id)}}" method="POST">
      <input type="hidden" name="_method" value="PATCH">

        {{ csrf_field() }}

      <div class="form-group">
        <label class="control-label col-sm-2" for="body">Comment:</label>
        <div class="col-sm-10">
          <textarea name="body" class="form-control" placeholder="Enter comment">{{ $comment->body }}</textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Update Comment</button>
        </div>
      </div>

    </form>
    <hr>
  @else
    <div class="alert alert-warning">
      Make an account or log in to post a comment.
    </div>
  @endif

  {{-- VIEW COMMENTS --}}

    <h1>Comments</h1>

    @foreach ($comments as $comment)
      <div class="well well-md">
        <div class="row">
          <div class="col-md-1 flex-center">
            @include('../partials/votes', ['id' => $comment->id, 'score' => $comment->score, 'name' => 'comments'])
          </div>
          <div class="col-md-2 line-right">
            <p>{{ $comment->user->name }}</p>
            <p>{{ Carbon\Carbon::parse($comment->created_at)->format('d-m-Y H u i') }}</p>
          </div>
          <div class="col-md-8">
            <p>{{ $comment->body }}</p>
          </div>
          {{-- EDIT & DELETE --}}
          <div class="col-md-1 flex-center">
            @if (Auth::user()->isAdmin || Auth::check() && $comment->user->name == Auth::user()->name)
              <form action="{{ url('/comments/' . $comment->id . '/edit') }}" method="post">
                {{ csrf_field() }}

                  <button type="submit" name="button" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-edit"></i></button>
              </form><br>
              <form action="{{ url('/comments/' . $comment->id) }}" method="post">
                {{ csrf_field() }}
                  <input type="hidden" name="_method" value="DELETE">

                  <button type="submit" name="button" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>
              </form>
            @endif
          </div>
        </div>
      </div>
    @endforeach
    <hr>




@endsection
