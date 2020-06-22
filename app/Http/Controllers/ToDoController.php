<?php

namespace App\Http\Controllers;

use App\ToDo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreToDoRequest;

class ToDoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function permission(ToDo $toDo) {
        $user = app('auth')->user();

        if ($toDo->user_id === $user->id) {
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
        $title = "ToDos";
        $todos = auth()->user()->todos;
        $bankOfColours = ['rgba(231, 76, 60, 0.75)', 'rgba(46, 204, 113, 0.75)'];
        return view('dashboard.todo.index', compact('title', 'todos', 'bankOfColours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreToDoRequest $request)
    {
        
        $todo = ToDo::create([
          'task' => request('task'),
          'user_id' => auth()->id()
        ]);

        return redirect()->route('todos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function show(ToDo $toDo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function edit(ToDo $toDo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToDo $toDo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToDo $toDo)
    {
        if ($this->permission($toDo)) {
            $toDo->delete();
            return redirect()->route('todos')->with('message', 'Well done you completed a task!');
        } else {
            $errors = [
              "You do not have permission to delete that resource!"
            ];
            return redirect()->route('todos')->withErrors($errors);
        }
    }
}
