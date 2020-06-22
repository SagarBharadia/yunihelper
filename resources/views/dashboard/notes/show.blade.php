@extends('partials.dashboard.master')

@section('content')
  <div class="title">
    <h1>{{$title}}</h1>
    <a href="/notes/{{$note->id}}/edit">Edit</a>
    <a href="/notes/{{$note->id}}/delete">Delete</a>
  </div>
  <div class="info-card-big">
    <h2>Description</h2>
    <p>{{$note->description}}</p>
  </div>
  <div class="info-card-medium">
    <h2>Module</h2>
    <p>{{$note->module}}</p>
  </div><!-- Whitespace remove
  --><div class="info-card-medium margin-right-none">
    <h2>Created at</h2>
    <p>{{$note->created_at}}</p>
  </div>
  <div>
    <h2>Body</h2>
    <p>{{$note->body}}</p>
  </div>
@endsection
