@extends('layout')

@section('navbar')
  | <a href="../books/">Terug naar Boeken</a>
@endsection

@section('content')
  <div class="book">
    <h3>{{ $book->title }}</h3>
    <p>Verkoper: <a href="../../sellers/{{ $book->seller->id}}">{{ $book->seller->name }} {{ $book->seller->surname }}</a></p>
    <p>Auteur: {{ $book->author }}</p>
    <p>Nieuwprijs: €{{ $book->newprice }}</p>
    <p>Prijs: €{{ $book->price }}</p>
    <p>Opmerking: {{ $book->comment }}</p>
  </div>
@endsection
