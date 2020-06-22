<?php

namespace App\Http\Controllers;

use App\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }
    public function permission(Assignment $assignment) {
      $user = app('auth')->user();

      if ($assignment->user_id === $user->id) {
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
        $title = "Assignments";
        $today = Carbon::today()->toDateString();
        $assignments = auth()->user()->assignments;

        $assignments_complete = DB::table('assignments')->where([
            ['user_id', '=', auth()->user()->id],
            ['complete', '=', '1']
        ])->get();
        $assignments_overdue = DB::table('assignments')->where([
            ['user_id', '=', auth()->user()->id],
            ['due_date', '<', $today],
            ['complete', '=', '0']
        ])->get();
        $assignments_not_complete = DB::table('assignments')->where([
            ['user_id', '=', auth()->user()->id],
            ['complete', '=', '0']
        ])->get();
        return view('dashboard.assignments.index', compact('title', 'assignments_complete', 'assignments_overdue', 'assignments_not_complete', 'today', 'assignments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create Assignment";
        return view('dashboard.assignments.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssignmentRequest $request)
    {
      $assignment = Assignment::create([
        'title' => request('title'),
        'due_date' => Carbon::parse(request('due_date')),
        'teacher' => request('teacher'),
        'module' => request('module'),
        'quick_notes' => request('quick_notes'),
        'complete' => false,
        'user_id' => auth()->id()
      ]);

      return redirect()->route('assignments');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        if ($this->permission($assignment)) {
            if ($assignment->complete == 1) {
                $assignmentStatus = "Complete";
            } elseif ($assignment->complete == 0) {
                $assignmentStatus = "Not Complete";
            }
            $title = $assignment->title;
            return view('dashboard.assignments.show', compact('assignment', 'title', 'assignmentStatus'));
        } else {
            $errors = [
                "You do not have permission to view that resource!"
            ];
            return redirect()->route('assignments')->withErrors($errors);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {

        if ($this->permission($assignment)) {
            if ($assignment->complete == 1) {
                $assignmentStatus = "Complete";
                $checked = "Checked";
            } elseif ($assignment->complete == 0) {
                $assignmentStatus = "Not Complete";
                $checked = "";
            }

            $title = "Edit ".$assignment->title;
            return view('dashboard.assignments.edit', compact('assignment', 'title', 'checked'));
        } else {
            $errors = [
                "You do not have permission to edit that resource!"
            ];
            return redirect()->route('assignments')->withErrors($errors);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssignmentRequest $request, Assignment $assignment)
    {
        if ($this->permission($assignment)) {

            if ( request('complete') == null) {
                $assignmentComplete = 0;
            } elseif (request('complete') == "on" ) {
                $assignmentComplete = 1;
            }

            $assignment->title = request('title');
            $assignment->due_date = request('due_date');
            $assignment->teacher = request('teacher');
            $assignment->module = request('module');
            $assignment->quick_notes = request('quick_notes');
            $assignment->complete = $assignmentComplete;
            $assignment->save();
            return redirect()->route('assignments')->with('message', 'Assignment updated.');
        } else {
            $errors = [
                "You do not have permission to update that resource!"
            ];
            return redirect()->route('assignments')->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        if($this->permission($assignment)) {
            $assignment->delete();
            return redirect()->route('assignments')->with('message', 'Assignment deleted.');
        } else {
            $errors = [
                "You do not have permission to delete that resource!"
            ];
            return redirect()->route('assignments')->withErrors($errors);
        }
    }
}
