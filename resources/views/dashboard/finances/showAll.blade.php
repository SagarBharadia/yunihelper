@extends ('partials.dashboard.master')

@section('content')

	<div class="title">
		<h1>All Financial Records</h1>
	</div>

	<table id="all-finance-records-table" class="custom-data-table">
		<thead>
	    	<tr>
		        <th>Name</th>
		        <th>Amount</th>
		        <th class="responsive-table">Direction</th>
		        <th>Date</th>
		    </tr>
	    </thead>
	    <tbody>
	      	@foreach ($allFinanceRecords as $record)
	        	<tr
	        		@if($record->direction=="In")
	        			class="finance-inbound"
	        		@else
	        			class="finance-outbound"
	        		@endif
	        		>
	          		<td onclick="window.document.location='/finances/{{$record->id}}';">{{$record->name}}</td>
	          		<td>£ {{number_format($record->amount, 2)}}</td>
	          		<td class="responsive-table">{{$record->direction}}</td>
	          		<td>{{Carbon\Carbon::parse($record->created_at)->format('d M Y')}}</td>
	        	</tr>
	      	@endforeach
	    </tbody>
	</table>

@endsection

@section('cssimports')
  <link rel="stylesheet" href="/css/dashboard/datatables.css">
@endsection

@section('jsimports')
  <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#all-finance-records-table').DataTable({
        responsive: true,
        pagingType: "simple"
      });
    });
  </script>
@endsection