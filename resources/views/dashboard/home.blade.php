@extends('partials.dashboard.master')

@section('content')
	<div id="dashboard">
		<div id="dash-date-wrapper">
			<h2 id="dashboard-day" style="text-decoration: none;"></h2>
			<h3 id="dashboard-date"></h3>
			<p id="dashboard-time"></p>
		</div>

		<div class="three-column-wrapper">

			<div class="three-column">
				<h2>Finances</h2>
				<a href="/finances">View more</a>
				<ul id="dash-finances">
					<li class="dash-stat-orange"><p class="align-left">Balance</p><p class="align-right">£{{$bankBalance}}</p><div class="clear"></div></li>
					<li class="dash-stat-red"><p class="align-left">Total Out</p><p class="align-right">£{{$totalOutForMonth}}</p><div class="clear"></div></li>
					<li class="dash-stat-green"><p class="align-left">Total In</p><p class="align-right">£{{$totalInForMonth}}</p><div class="clear"></div></li>

				</ul>
				<h3>Recent Transactions</h3>
				<ul id="dash-finances-recent-purchases">

					@if(count($bankBalanceRecord) == 0)
						<p>Looks like you haven't set your initial balance! Click <a href="/finances" style="text-decoration: underline;">here</a> to get started!</p>
					@elseif(count($finances) == 0)
						<p>Doesn't look like you have any transactions. Click <a href="/finances/additem" style="text-decoration: underline;">here</a> to get started!</p>
					@else
						@foreach($finances as $finance)
							<li onclick="window.document.location='/finances/{{$finance->id}}';"
								@if($finance->direction == 'In')
									class="dash-stat-green"
								@endif
								><p class="align-left">{{$finance->name}}</p><p class="align-right">£{{$finance->amount}}</p><div class="clear"></div></li>
						@endforeach
					@endif

				</ul>
			</div><!-- White space remove
			--><div class="three-column">
				<h2>Todos (Last 5)</h2> 
				<a href="/todos">View all</a>
				@if(count($todos) == 0)
					<p>You should add some tasks! Click <a href="/todos" style="text-decoration: underline;">here</a> to get started!</p>
				@else
					<ul id="dashboardtodolist">
						@foreach($todos as $todo)
							<li>{{$todo->task}}</li>
						@endforeach
					</ul>
				@endif
			</div><!-- Whitespace remove
			--><div class="three-column margin-right-none">
				<h2>Assignments</h2>
				<a href="/assignments">View all</a>
				<ul id="dash-assignments-stats">
					<li class="dash-stat-red dash-assignments-stat"><p class="align-left">Overdue</p><p class="align-right">{{count($assignments_overdue)}}</p><div class="clear"></div></li>
					<li class="dash-stat-orange dash-assignments-stat"><p class="align-left">Not Complete</p><p class="align-right">{{count($assignments_not_complete)}}</p><div class="clear"></div></li>
					<li class="dash-stat-green dash-assignments-stat"><p class="align-left">Complete</p><p class="align-right">{{count($assignments_complete)}}</p><div class="clear"></div></li>
				</ul>
				<h3>Upcoming assignments</h3>
				@if(count($assignments) == 0)
					<p>You should add some assignments! Click <a href="/assignments" style="text-decoration: underline;">here</a> to get started!</p>
				@else
					<ul id="dash-upcoming-assignments">
						@foreach($assignments as $assignment)
							<li onclick="window.document.location='/assignments/{{$assignment->id}}';"><p class="align-left">{{$assignment->title}}</p><p class="align-right">{{$assignment->due_date}}</p><div class="clear"></div></li>
						@endforeach
					</ul>
				@endif
			</div>

		</div>
		<div class="one-column">
			<h2>Recent Notes</h2>
			<a href="/notes">View more</a>
			
				@if(count($notes) == 0)
					<p>You should add some notes! Click <a href="/notes" style="text-decoration: underline;">here</a> to get started!</p>
				@else
					<ul id="dash-recent-notes">
						@foreach($notes as $note)
							<li onclick="window.document.location='/notes/{{$note->id}}';">{{$note->title}}</li>
						@endforeach
					</ul>
				@endif
		
		</div>
	</div>

@endsection

@section('jsimports')
	<script type="text/javascript" src="/js/dashboard.js"></script>
@endsection
