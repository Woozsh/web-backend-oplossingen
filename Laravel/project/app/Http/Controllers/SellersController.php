<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seller;
use App\Book;

class SellersController extends Controller
{
  public function index()
  {
    $sellers = Seller::all();
    return view('sellers.index', compact('sellers'));
  }

  public function show(Seller $seller)
  {
    return view('sellers.show', compact('seller'));
  }

  public function addBook(Request $request, Seller $seller)
  {
    $this->validate($request, [
      'title' => 'required',
      'author' => 'required',
      'newprice' => 'required',
      'price' => 'required'
    ]);

    $seller->addBook(
      new Book($request->all())
    );

    return back();
  }

  public function addSeller(Request $request, Seller $seller)
  {
    $this->validate($request, [
      'name' => 'required',
      'surname' => 'required',
      'email' => 'required',
      'phone' => 'required'
    ]);

    $seller->create($request->all());

    return back();
  }
}
