@extends('partials.dashboard.master')

@section('content')
  <form method="POST" action="/assignments/{{$assignment->id}}/update">
    {{ csrf_field() }}
    <div class="title">
      <h1>
        <input style="display: inline-block;" name="title" id="title" value="{{$assignment->title}}" autocomplete="off" required>
      </h1>
      <button type="submit">Update</button>
      <label>Complete <input type="checkbox" name="complete" id="complete" {{$checked}}/></label>
    </div><div class="info-card-small">
      <h2>Due Date</h2>
      <input type="text" name="due_date" id="due_date" placeholder="dd-mm-yyyy" value="<?php echo "$assignment->due_date"; ?>" autocomplete="off" required>
    </div><div class="info-card-small">
      <h2>Teacher</h2>
      <input type="text" name="teacher" id="teacher" value="<?php echo "$assignment->teacher"; ?>" autocomplete="off">
    </div><div class="info-card-small">
      <h2>Module Name</h2>
      <input type="text" name="module" id="module" value="<?php echo "$assignment->module"; ?>" autocomplete="off">
    </div>
    <div class="info-card-body-text">
      <h2>Quick Notes</h2>
      <textarea name="quick_notes" id="quick_notes" placeholder="Extra information / Quick notes"><?php echo "$assignment->quick_notes"; ?></textarea>
    </div>
  </form>
@endsection
