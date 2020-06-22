@extends ('partials.dashboard.master')

@section ('content')
	
	<div class="title" id="todotitle">
		<h1 style="display: inline-block !important;">{{$title}}</h1><!-- Whitespace remove
	--><i class="fa fa-plus-square-o fa-2x" onclick="openModal()"></i>
	</div>
	
	@if(count($todos) == 0)
		<h2>You should add some tasks!</h2>
		<h3>(Hint: Use the <i class="fa fa-plus-square-o"></i> to add some!)</h3>
	@else
		<ul id="todolist">
			@foreach ($todos as $todo)

				<li><div class="todolisttext">{{$todo->task}}</div><div class="todolistcross" onclick="window.document.location='/todos/{{$todo->id}}/destroy';"><i class="fa fa-times"></i></div><div class="clear"></div></li>

			@endforeach
		</ul>
	@endif

	<div class="modal">
		<div class="inner-modal">
			<i class="fa fa-times fa-2x" id="closeModal" onclick="closeModal()"></i>
			<h1>Add Task</h1>
			<form method="POST" action="/todos/store">
				{{ csrf_field() }}
				<textarea class="todo-task-textarea" name="task" id="task" placeholder="Enter your todo!">{{ old('task') }}</textarea>
				<button type="submit">Add!</button>
				<div class="clear"></div>
			</form>
		</div>
	</div>

@endsection

@section ('jsimports')
<script type="text/javascript" src="/js/modal.js"></script>
@endsection