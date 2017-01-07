<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Boek;

class BoekenController extends Controller
{
    public function index()
    {
      $boeken = Boek::all();
      return view('boeken.index', compact('boeken'));
    }
}
