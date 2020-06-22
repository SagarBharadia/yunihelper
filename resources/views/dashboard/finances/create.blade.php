@extends('partials.dashboard.master')

@section('content')
  <form method="POST" action="/finances/storeitem">
    {{ csrf_field() }}
    <div class="title">
      <h1><input name="name" id="name" placeholder="Name of purchase" autocomplete="off" value="{{ old('name') }}" required></h1><!-- White space remove
      --><button type="submit">Save Record</button>
    </div>
    <div class="info-wrapper">
      <div class="info-card-medium">
        <h2>Amount</h2>
        <label>£ <input name="amount" id="amount" placeholder="Enter amount" class="width-auto" autocomplete="off" value="{{ old('amount') }}" required></label>
      </div><!-- White space remove
      --><div class="info-card-medium margin-right-none">
        <h2>Direction</h2>
        <label><input type="radio" id="direction" name="direction" value="Out" checked> Outbound</label>
        <label><input type="radio" id="direction" name="direction" value="In"> Inbound</label>
      </div>
    </div>
    <div class="info-card-big">
      <h2>Reason</h2>
      <input placeholder="Reason for purchase" name="reason" id="reason" value="{{ old('reason') }}" autocomplete="off">
    </div>
  </form>
@endsection