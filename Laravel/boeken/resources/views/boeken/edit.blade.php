@extends('layout')

@section('navbar')
  | <a href="/books">Terug naar boeken</a> | <a href="/sellers/{{$book->seller->id}}">Terug naar verkoper</a>
@endsection
@section('content')
  <h1>Edit the Book from {{$book->seller->name}} {{$book->seller->surname}}</h1>

  <form class="form-horizontal" action="/books/{{$book->id}}" method="POST">
    
    {{ method_field('PATCH') }}
    {{ csrf_field() }}

      <div class="form-group">
        <label class="control-label col-sm-2" for="title">Title:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="author">Author:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="newprice">Original Price:</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="newprice" name="newprice" value="{{ $book->newprice }}">
        </div>
      </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="price">Price:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="price" name="price" value="{{ $book->price }}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="comment">Comment:</label>
      <div class="col-sm-10">
        <textarea name="comment" class="form-control">{{ $book->comment }}</textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Edit Book</button>
      </div>
    </div>
  </form>
@endsection
