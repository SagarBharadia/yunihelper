<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;

class NoteController extends Controller
{

  public function __construct() {
    $this->middleware('auth');
  }

  public function permission(Note $note) {
    $user = app('auth')->user();

    if ($note->user_id === $user->id) {
      return true;
    } else {
      return false;
    }
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $title = "Notes";
    $notes = auth()->user()->notes;
    return view('dashboard.notes.index', compact('title', 'notes'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $title = "Create Note";
      return view('dashboard.notes.create', compact('title'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreNoteRequest $request)
  {

    $note = Note::create([
      'title' => request('title'),
      'description' => request('description'),
      'body' => request('body'),
      'module' => request('module'),
      'user_id' => auth()->id()
    ]);

    return redirect()->route('notes');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Note  $note
   * @return \Illuminate\Http\Response
   */
  public function show(Note $note)
  {

    if ($this->permission($note)) {
      $title = $note->title;
      return view('dashboard.notes.show', compact('note', 'title'));
    } else {
      $errors = [
        "You do not have permission to view that resource!"
      ];
      return redirect()->route('notes')->withErrors($errors);
    }

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Note  $note
   * @return \Illuminate\Http\Response
   */
  public function edit(Note $note)
  {

    if ($this->permission($note)) {
      $title = 'Edit '.$note->title;
      return view('dashboard.notes.edit', compact('note', 'title'));
    } else {
      $errors = [
        "You do not have permission to edit that resource!"
      ];
      return redirect()->route('notes')->withErrors($errors);
    }

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Note  $note
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateNoteRequest $request, Note $note)
  {
    if ($this->permission($note)) {
      $note->title = request('title');
      $note->description = request('description');
      $note->module = request('module');
      $note->body = request('body');
      $note->save();
      return redirect()->route('notes')->with('message', 'Note updated.');
    } else {
      $errors = [
        "You do not have permission to update that resource!"
      ];
      return redirect()->route('notes')->withErrors($errors);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Note  $note
   * @return \Illuminate\Http\Response
   */
  public function destroy(Note $note)
  {
      if($this->permission($note)) {
        $note->delete();
        return redirect()->route('notes')->with('message', 'Note deleted.');
      } else {
        $errors = [
          "You do not have permission to delete that resource!"
        ];
        return redirect()->route('notes')->withErrors($errors);
      }
  }
}
