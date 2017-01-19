@foreach ($comments as $comment)
  <div class="well well-md">
    {{-- SHOW COMMENT IF PARENT ID = 0--}}
    <div class="row">
      <div class="col-md-1 flex-center">
        @include('../partials/votes', ['id' => $comment->id, 'score' => $comment->score, 'name' => 'comments'])
      </div>
      <div class="col-md-2 line-right">
        <p>{{ $comment->user->name }}</p>
        <p>{{ Carbon\Carbon::parse($comment->created_at)->format('d-m-Y H:i') }}</p>
      </div>
      <div class="col-md-8">
        <p>{{ $comment->body }}</p>
      </div>
      {{-- EDIT & DELETE --}}
      <div class="col-md-1 flex-center">
        @if (Auth::check() && (Auth::user()->isAdmin || $comment->user->name == Auth::user()->name))
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
    {{-- INSERT REPLY --}}
    <div class="row">
      <div class="col-md-offset-3 col-md-8">

        @if (Auth::check())
          <form action="{{ url('/posts/' . 'reply/' . $comment->id) }}" method="post">
              {{ csrf_field() }}
                <div class="input-group">
                  <input type="text" class="form-control" id="body" name="body" placeholder="Enter reply on Comment">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Reply</button>
                  </span>
                </div>
          </form>
        @endif

      </div>
      <div class="col-md-1">

      </div>
    </div> {{-- END ROW --}}

    {{-- SHOW REPLIES IF PARENT ID = COMMENT--}}
    @include('../partials/showReplies')

  </div>
@endforeach
