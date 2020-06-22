@extends('partials.dashboard.master')

@section('content')
  <div class="title">
    <h1>{{ $title }}</h1><!-- White space removal
    --><a href="/assignments/create">New Assignment</a>
  </div>
  <div id="stats-wrapper">
  	<div class="stat-card stat-card-red">
  		<h2>Overdue</h2>
  		<h3>{{count($assignments_overdue)}}</h3>
  	</div><!-- Whitespace remove
  	--><div class="stat-card stat-card-orange">
  		<h2>Not Complete</h2>
  		<h3>{{count($assignments_not_complete)}}</h3>
  	</div><!-- Whitespace remove
  	--><div class="stat-card stat-card-green">
  		<h2>Complete</h2>
  		<h3>{{count($assignments_complete)}}</h3>
  	</div>
  </div>
  <br>
  <table id="assignmentstable" class="custom-data-table">
    <thead>
      <tr>
        <th>Title</th>
        <th class="responsive-table">Module</th>
        <th>Overdue</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($assignments as $assignment)

        @php
          if ( !($assignment->complete) && ($assignment->due_date < $today) ) {
            $overdue = "Yes";
          } else {
            $overdue = "No";
          } 
          if ($assignment->complete == 1) {
            $assignmentStatus = "Complete";
          } elseif ($assignment->complete == 0) {
            $assignmentStatus = "Not Complete";
          }
        @endphp

        <tr onclick="window.document.location='/assignments/{{$assignment->id}}';">
          <td>{{$assignment->title}}</td>
          <td class="responsive-table">{{$assignment->module}}</td>
          <td>{{$overdue}}</td>
          <td>{{$assignmentStatus}}</td>
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
      $('#assignmentstable').DataTable({
        responsive: true,
        pagingType: "simple"
      });
    });
  </script>
@endsection