<?php

namespace App\Http\Controllers;

use App\Models\Note;
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
      // Validate request
      $request->validate(
        // Rules
         [
             'text_title' => 'required|min:3|max:200',
             'text_note' => 'required|min:3|max:3000'
         ],
         // Error messages
         [
             'text_title.required' => 'O título é obrigatório',
             'text_title.min' => 'O título deve ter no mínimo :min caracteres',
             'text_title.max' => 'O título deve ter no mínimo :max caracteres',
             'text_note.required' => 'A nota é obrigatória',
             'text_note.min' => 'A nota deve ter no mínimo :min caracteres',
             'text_note.max' => 'A nota deve ter no mínimo :max caracteres'
         ]
     );

      // Get user id
      $id = session('user.id');

      // Create new note
      $note = new Note();
      $note->user_id = $id;
      $note->title = $request->text_title;
      $note->text = $request->text_note;
      $note->save();

      // Redirect to home
      return redirect()->route('home');
    }

    public function editNote($id)
    {
      $id = Operations::decryptId($id);

      // Load note
      $note = Note::find($id);

      // Show edit note view
      return view('edit_note', ['note' => $note]);
    }

    public function editNoteSubmit(Request $request)
    {
      // Validate request
      $request->validate(
        // Rules
         [
             'text_title' => 'required|min:3|max:200',
             'text_note' => 'required|min:3|max:3000'
         ],
         // Error messages
         [
             'text_title.required' => 'O título é obrigatório',
             'text_title.min' => 'O título deve ter no mínimo :min caracteres',
             'text_title.max' => 'O título deve ter no mínimo :max caracteres',
             'text_note.required' => 'A nota é obrigatória',
             'text_note.min' => 'A nota deve ter no mínimo :min caracteres',
             'text_note.max' => 'A nota deve ter no mínimo :max caracteres'
         ]
     );

     // Check if note id exists
     if($request->note_id == null) {
      return redirect()->route('home');
     }

      // Decrypt note_id
     $id = Operations::decryptId($request->note_id);

      // Load note
      $note = Note::find($id);

      // Update note
      $note->title = $request->text_title;
      $note->text = $request->text_note;
      $note->save();

      //Redirect to home
      return redirect()->route('home');
    }

    public function deleteNote($id)
    {
      // $id = $this->decryptId($id);
      $id = Operations::decryptId($id);
    }
}