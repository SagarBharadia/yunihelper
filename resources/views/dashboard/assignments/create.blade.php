@extends('partials.dashboard.master')

@section('content')
  <form method="POST" action="/assignments/store">
    {{ csrf_field() }}
    <div class="title">
      <h1><input name="title" id="title" placeholder="Title" autocomplete="off" value="{{ old('title') }}" required></h1>
      <button type="submit" name="button">Save</button>
    </div>
    <div class="info-card-small">
      <h2>Due Date</h2>
      <input type="text" name="due_date" id="due_date" placeholder="dd-mm-yyyy" autocomplete="off" value="{{ old('due_date') }}" required>
    </div><div class="info-card-small">
      <h2>Teacher</h2>
      <input type="text" name="teacher" id="teacher" placeholder="Teacher" autocomplete="off" value="{{ old('teacher') }}">
    </div><div class="info-card-small">
      <h2>Module Name</h2>
      <input type="text" name="module" id="module" placeholder="Module" autocomplete="off" value="{{ old('module') }}">
    </div>
    <div class="info-card-body-text">
      <h2>Quick Notes</h2>
      <textarea name="quick_notes" id="quick_notes" placeholder="Extra information / Quick notes">{{ old('quick_notes') }}</textarea>
    </div>
  </form>
@endsection
