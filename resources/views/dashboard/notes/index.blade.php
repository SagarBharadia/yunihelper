@extends('partials.dashboard.master')

@section('content')

  <div class="title">
    <h1>{{$title}}</h1><!-- White space removal
    --><a href="/notes/create">New Note</a>
  </div>

  <table id="notestable" class="custom-data-table">
    <thead>
      <tr>
        <th>Title</th>
        <th class="responsive-table">Description</th>
        <th>Module</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($notes as $note)
        <tr onclick="window.document.location='/notes/{{$note->id}}';">
          <td>{{$note->title}}</td>
          <td class="responsive-table">{{$note->description}}</td>
          <td >{{$note->module}}</td>
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
      $('#notestable').DataTable({
        responsive: true,
        pagingType: "simple"
      });
    });
  </script>
@endsection
