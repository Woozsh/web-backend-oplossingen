@extends('layout')

@section('title')
  Boeken
@endsection

@section('content')
  <h1>Alle boeken</h1>
  @foreach ($boeken as $boek)
    <div class="">
      <p>{{ $boek->title }}</p>
    </div>
  @endforeach
@endsection
