<form @if (Auth::check())action="/{{ $name }}/{{ $id }}/upvote"@endif method="post">
    {{ csrf_field() }}

    <button type="submit" name="button" class="no-btn glyphicon glyphicon-chevron-up"></button>
</form>
Score: {{ $score }}
<form @if (Auth::check())action="/{{ $name }}/{{ $id }}/downvote"@endif method="post">
    {{ csrf_field() }}

    <button type="submit" name="button" class="no-btn glyphicon glyphicon-chevron-down"></button>
</form>
