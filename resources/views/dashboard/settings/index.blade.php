@extends('partials.dashboard.master')

@section('content')

	<div class="title">
		<h1>{{ $title }}</h1>
	</div>

	<div id="settings">
		
		<div class="settings-tile">
			<h2>Profile Settings</h2>
			<form method="POST" action="/settings/profile/update">
				{{ csrf_field() }}
				<p>
					First Name:
					<input class="align-right" type="text" placeholder="First Name" name="firstname" id="firstname" autocomplete="off" value="{{ auth()->user()->firstname }}" required>
				</p>
				<hr>
				<p>
					Last Name
					<input class="align-right" type="text" placeholder="Last Name" name="lastname" id="lastname" autocomplete="off" value="{{ auth()->user()->lastname }}" required>
				</p>
				<hr>
				<p>
					<span>Username:</span>
					<span class="align-right disabled">{{ auth()->user()->username }}</span>
				</p>
				<hr>
				<p>
					<span>Email: </span>
					<span  class="align-right disabled">{{ auth()->user()->email }}</span>
				</p>
				<hr>
				<button class="align-right" type="submit">Update Values</button>
			</form>
		</div>

	</div>

@endsection