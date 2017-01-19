<div class="row">
  <div class="col-md-offset-1 col-md-11">
    @foreach ($replies as $reply)
      <div class="row">
        <div class="col-md-1 flex-center">
          @include('../partials/votes', ['id' => $reply->id, 'score' => $reply->score, 'name' => 'replies'])
        </div>
        <div class="col-md-2 line-right">
          <p>{{ $reply->user->name }}</p>
          <p>{{ Carbon\Carbon::parse($reply->created_at)->format('d-m-Y H:i') }}</p>
        </div>
        <div class="col-md-8">
          <p>{{ $reply->body }}</p>
        </div>
        {{-- EDIT & DELETE --}}
        <div class="col-md-1 flex-center">
          @if (Auth::check() && (Auth::user()->isAdmin || $reply->user->name == Auth::user()->name))
            <form action="{{ url('/comments/' . $reply->id . '/edit') }}" method="post">
              {{ csrf_field() }}

                <button type="submit" name="button" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-edit"></i></button>
            </form><br>
            <form action="{{ url('/comments/' . $reply->id) }}" method="post">
              {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">

                <button type="submit" name="button" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>
            </form>
          @endif
        </div>
      </div>
    @endforeach
  </div>

</div>
