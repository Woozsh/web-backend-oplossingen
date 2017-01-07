@extends('layout')

@section('title')
  About Page
@endsection

@section('content')
  <h1>I wish Leandro for 2017 a lot of:</h1>

  <ul class="list-unstyled">
    @foreach($keywords as $key)
      <li>{{ $key }}</li>
    @endforeach
  </ul>


@endsection
