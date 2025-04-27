<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;
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
      // $id = $this->decryptId($id);
      $id = Operations::decryptId($id);
    }

    public function deleteNote($id)
    {
      // $id = $this->decryptId($id);
      $id = Operations::decryptId($id);
    }
}