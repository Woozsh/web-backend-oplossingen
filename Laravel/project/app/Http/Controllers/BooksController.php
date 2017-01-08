<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BooksController extends Controller
{
  public function index()
  {
    $books = Book::all();
    return view('boeken.index', compact('books'));
  }

  public function show(Book $book)
  {
    return view('boeken.show', compact('book'));
  }

  public function edit(Book $book)
  {
    return view('boeken.edit', compact('book'));
  }

  public function update(Request $request, Book $book)
  {
    $book->update($request->all());

    return back();
  }
}
