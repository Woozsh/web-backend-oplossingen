<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
      return view('welcome');
    }

    public function about()
    {
      $keywords = ['Wieners', 'Penises', 'Crotches'];
      return view('about', compact('keywords'));
    }

    
}
