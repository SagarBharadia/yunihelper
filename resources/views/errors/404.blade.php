@extends('partials.staticpages.master')

@section('content')
  @include('partials.staticpages.header')
  <section>
	  <div id="errorPageWrapper">
	  	<div class="errorpage">
	    	<h1>Uh, we couldn't find what you were looking for!</h1>
	    	<h3>Error 404</h3>
	  	</div>
	  </div>
  </section>
  @include('partials.staticpages.footer')

@endsection