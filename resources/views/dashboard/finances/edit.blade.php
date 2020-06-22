@extends('partials.dashboard.master')

@section('content')
  <form method="POST" action="/finances/{{$finance->id}}/update">
    {{ csrf_field() }}
    <div class="title">
      <h1><input name="name" id="name" value="{{$finance->name}}" autocomplete="off" required></h1><!-- White space remove
      --><button type="submit">Save Record</button>
    </div>
    <div class="info-wrapper">
      <div class="info-card-medium">
        <h2>Amount</h2>
        <label>£ <input name="amount" id="amount" value="{{$finance->amount}}" class="width-auto" autocomplete="off" required></label>
      </div><!-- White space remove
      --><div class="info-card-medium margin-right-none">
        <h2>Direction</h2>
        @if ($finance->direction == "Out")
          <label><input type="radio" id="direction" name="direction" value="Out" checked> Outbound</label>
          <label><input type="radio" id="direction" name="direction" value="In"> Inbound</label>
        @elseif ($finance->direction == "In")
          <label><input type="radio" id="direction" name="direction" value="Out"> Outbound</label>
          <label><input type="radio" id="direction" name="direction" value="In" checked> Inbound</label>
        @endif
      </div>
    </div>
    <div class="info-card-big">
      <h2>Reason</h2>
      <input value="{{$finance->reason}}" name="reason" id="reason" autocomplete="off">
    </div>
  </form>
@endsection