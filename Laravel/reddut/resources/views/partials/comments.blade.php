@foreach ($comments as $comment)
  <div class="well well-md">
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
  </div>
@endforeach
