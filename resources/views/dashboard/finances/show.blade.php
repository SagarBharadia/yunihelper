@extends('partials.dashboard.master')

@section('content')
  <div class="title">
    <h1>{{$finance->name}}</h1><!-- White space remove
    --><a href="/finances/{{$finance->id}}/edit">Edit</a><!-- White space remove
    --><a href="/finances/{{$finance->id}}/delete">Delete</a>
  </div>
  <div class="info-wrapper">
    <div class="info-card-medium">
      <h2>Amount</h2>
      <h3>£ {{$finance->amount}}</h3>
    </div><!-- White space remove
    --><div class="info-card-medium margin-right-none">
      <h2>Direction</h2>
      @if ($finance->direction == "Out")
        <h3>Outbound</h3>
      @elseif ($finance->direction == "In")
        <h3>Inbound</h3>
      @endif
    </div>
  </div>
  <div class="info-card-big">
    <h2>Reason</h2>
    <h3>{{$finance->reason}}</h3>
  </div>
@endsection