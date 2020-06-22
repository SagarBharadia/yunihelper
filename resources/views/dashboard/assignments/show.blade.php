@extends('partials.dashboard.master')

@section('content')
  <div class="title">
    <h1>{{$assignment->title}}</h1>
    <a href="/assignments/{{$assignment->id}}/edit">Edit</a>
    <a href="/assignments/{{$assignment->id}}/delete">Delete</a>
  </div>

  @if($assignment->complete == 1)
    <div class="success-messages">
      <p>{{$assignmentStatus}}</p>
    </div>
  @else
    <div class="error-messages">
      <p>{{$assignmentStatus}}</p>
    </div>
  @endif

  <div class="info-card-small">
    <h2>Due Date</h2>
    <p>{{$assignment->due_date}}</p>
  </div><div class="info-card-small">
    <h2>Teacher</h2>
    <p>{{$assignment->teacher}}</p>
  </div><div class="info-card-small last-of-type">
    <h2>Module Name</h2>
    <p>{{$assignment->module}}</p>
  </div>
  <div class="info-card-body-text">
    <h2>Quick Notes</h2>
    <p>{{$assignment->quick_notes}}</p>
  </div>

@endsection
