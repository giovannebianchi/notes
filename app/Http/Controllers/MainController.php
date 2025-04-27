<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
      // Load user's notes

      // Show home view
      return view('home');
    }

    public function newNote()
    {
      echo 'I\'m creating a new note';
    }
}