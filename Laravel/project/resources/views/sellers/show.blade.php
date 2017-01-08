@extends('layout')

@section('navbar')
  | <a href="../sellers">Terug naar Verkopers</a>

@endsection
@section('content')
  <h1>Gegevens van {{ $seller->name }} {{ $seller->surname }}</h1>
  <ul>
    <li>{{ $seller->name }}</li>
    <li>{{ $seller->surname }}</li>
    <li>{{ $seller->email }}</li>
    <li>{{ $seller->phone }}</li>
  </ul>
  <h2>Voeg een boek toe van deze verkoper</h2>
  <form class="form-horizontal" action="/sellers/{{ $seller->id }}/books" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group">
        <label class="control-label col-sm-2" for="title">Title:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="title" name="title"placeholder="Enter title">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="author">Author:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="author" name="author" placeholder="Enter author">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="newprice">Original Price:</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="newprice" name="newprice" placeholder="Enter newprice">
        </div>
      </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="price">Price:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="price" name="price" placeholder="Enter price">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="comment">Comment:</label>
      <div class="col-sm-10">
        <textarea name="comment" class="form-control" placeholder="Enter comment"></textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Add Book</button>
      </div>
    </div>
  </form>
  <h1>Alle boeken van {{ $seller->name }} {{ $seller->surname }}</h1>
  @foreach ($seller->books as $book)
    <div class="book">
      <a href="../../books/{{ $book->id}}"><h3>{{ $book->title }}</h3></a>
      <p>{{ $book->author }} | €{{ $book->price }}</p>
      <p><a href="/books/{{$book->id}}/edit">Edit</a></p>
    </div>
  @endforeach
@endsection
