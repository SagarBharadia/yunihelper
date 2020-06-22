@extends ('partials.dashboard.master')

@section('content')

	<div class="title">
		<h1>{{$title}}</h1><!-- White space removal
    	--><a href="/finances/additem">New Record</a>
	</div>

	@if ($bankBalanceSet == false)

		<div class="modal" style="display: block;">
			<div class="inner-modal">
				<p>To use this feature you <i><strong>must</strong></i> set a initial balance!</p>
				<form method="POST" action="/finances/setbalance">
					{{ csrf_field() }}
					<input type="number" step="0.01" name="balance" id="balance" placeholder="250.00"></input>
					<button type="submit">Set Balance</button>
					<div class="clear"></div>
				</form>
			</div>
		</div>

	@endif

	<div id="stats-wrapper">
		<p class="stat-message">Statistics shown below are for the current month.</p>
		<div class="stat-card stat-card-green">
			<h2>Total In</h2>
			<h3>£ {{number_format($totalInForMonth, 2)}}</h3>
		</div><!-- Whitespace remove
		--><div class="stat-card stat-card-red">
			<h2>Total Out</h2>	
			<h3>£ {{number_format($totalOutForMonth, 2)}}</h3>
		</div><!-- Whitespace remove
		--><div class="stat-card stat-card-orange">
			<h2>Balance</h2>
			<h3>£ {{number_format($bankBalance, 2)}}</h3>
		</div>
	</div>

	<div class="title">
		<h1>Recent 10 Records</h1><!-- White space removal
    	--><a href="/finances/all">View All</a>
	</div>

	<table id="finances-table" class="custom-data-table" cellspacing="0"	>
	    <thead>
	    	<tr>
		        <th>Name</th>
		        <th>Amount</th>
		        <th class="responsive-table">Direction</th>
		        <th>Date</th>
		    </tr>
	    </thead>
	    <tbody>
	      	@foreach ($tenMostRecentRecords as $record)
	        	<tr onclick="window.document.location='/finances/{{$record->id}}';"

	        		@if($record->direction=="In")
	        			class="finance-inbound"
	        		@else
	        			class="finance-outbound"
	        		@endif
	        		
	        		>
	          		<td>{{$record->name}}</td>
	          		<td>£ {{number_format($record->amount, 2)}}</td>
	          		<td class="responsive-table">{{$record->direction}}</td>
	          		<td>{{Carbon\Carbon::parse($record->created_at)->format('d M Y')}}</td>
	        	</tr>
	      	@endforeach
	    </tbody>
  	</table>

@endsection

@section('jsimports')

	@if($bankBalanceSet == false)
		<script type="text/javascript">
			$(document).ready(function() {
				$('html').css('overflow-y', 'hidden');
			});

		</script>
	@endif

@endsection