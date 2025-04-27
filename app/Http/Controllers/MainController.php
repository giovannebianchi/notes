<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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

    public function editNote($id)
    {
      try {
        $id = Crypt::decrypt($id);
      } catch (DecryptException $e) {
        return redirect()->route('home');
      }
    }

    public function deleteNote($id)
    {
      try {
        $id = Crypt::decrypt($id);
      } catch (DecryptException $e) {
        return redirect()->route('home');
      }
    }
}