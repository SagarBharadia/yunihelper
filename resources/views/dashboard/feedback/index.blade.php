@extends('partials.dashboard.master')

@section('content')
  <div class="title">
    <h1>{{ $title }}</h1>
  </div>
  <p>All the feedback here is stored anonymously!</p>
	<div id="feedback">
			<form method="POST" action="/feedback/store">
				{{ csrf_field() }}
				<input class="text-align-left" type="text" value="{{ old('heading') }}" name="heading" id="heading" placeholder="Title">
				<span id="type-of-feedback-selector">
					Type:
					<select name="type_of_feedback" id="type_of_feedback">
						<option value=0 default>Suggestion</option>
						<option value=1>Bug Report</option>
					</select>
				</span>
				<hr>
				<textarea name="body" id="body" value="{{ old('body') }}" placeholder="Please enter your text here"></textarea>
				<button class="align-right" type="submit">Submit</button>
			</form>
	</div>
@endsection