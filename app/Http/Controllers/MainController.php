<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;
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
      // Show new note view
      return view('new_note');
    }

    public function newNoteSubmit(Request $request)
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