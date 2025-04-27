<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
      // Load user's notes
      $id = session('user.id');
      $notes = user::find($id)->notes()->get()->toArray();

      // Show home view
      return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
      echo 'I\'m creating a new note';
    }
}