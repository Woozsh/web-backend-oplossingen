@extends('layout')

@section('title')
  Boeken
@endsection

@section('content')
  <h1>Voeg een nieuwe verkoper toe</h1>
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
    <form class="form-horizontal" action="sellers" method="POST">

      {{ csrf_field() }}

      <div class="form-group">
        <label class="control-label col-sm-2" for="name">Name:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="surname">Surname:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter surname" value="{{ old('surname') }}">
        </div>
      </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="phone">Phone:</label>
      <div class="col-sm-10">
        <input type="phone" class="form-control" id="phone" name="phone" placeholder="Enter phone" value="{{ old('phone') }}">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
  <h1>Alle Verkopers</h1>
  @foreach ($sellers as $seller)
    <a href="sellers/{{ $seller->id }}">
      <div class="well">
        <p>{{ $seller->name }} {{ $seller->surname }}</p>
        <p>Aantal boeken: {{ count($seller->books) }}</p>
      </div>
    </a>

  @endforeach
@endsection
