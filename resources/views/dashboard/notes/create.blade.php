@extends('partials.dashboard.master')

@section('content')
  <form method="POST" action="/notes/store">
    {{ csrf_field() }}
    <div class="title">
      <h1><input name="title" id="title" placeholder="Enter title" autocomplete="off" value="{{ old('title') }}" required></h1>
      <button type="submit">Save Note</button>
    </div>
    <div class="info-card-medium">
      <h2>Description</h2>
      <textarea name="description" id="description" value="{{ old('description') }}" placeholder="Brief description of note" required></textarea>
    </div><!-- Whitespace remove
    --><div class="info-card-medium margin-right-none">
      <h2>Module</h2>
      <textarea placeholder="Module name" name="module" id="module" placeholder="Module">{{ old('module') }}</textarea>
    </div>
    <div class="info-card-body-text">
      <h2>Body</h2>
      <textarea name="body" id="body" placeholder="Type away your notes..." required>{{ old('body') }}</textarea>
    </div>
  </form>
@endsection
