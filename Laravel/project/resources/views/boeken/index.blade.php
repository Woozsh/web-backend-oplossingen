@extends('layout')

@section('title')
  Boeken
@endsection

@section('content')
  <h1>Alle boeken</h1>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Titel</th>
          <th>Verkoper</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($books as $book)
            <tr class='clickable-row' data-href='/{{ $book->id }}'>
              <td>{{ $book->id}}</td>
              <td>{{ $book->title }}</td>
              <td>{{ $book->seller->name }} {{ $book->seller->surname }}</td>
              <td><a href="/books/{{$book->id}}/edit">Edit</a></td>
              <td><a href="../books/{{ $book->id }}">Meer info</a></td>


            </tr>
        @endforeach
      </tbody>
  </table>
  </div>

@endsection
