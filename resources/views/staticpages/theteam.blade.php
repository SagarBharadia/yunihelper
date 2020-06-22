@extends('partials.staticpages.master')

@section('content')

	@include('partials.staticpages.header')
	<section id="the-team">
		<h1 id="the-team-title">Meet the team!</h1>
		<div class="team-member">
			<div class="team-member-image">
				<img src="/img/temp.png">
			</div>			
			<div class="team-member-text">
				<h2>Developer</h2>
				<h1>Sagar Bharadia</h1>
				<p>Sagar is the developer of YuniHelper and the initiator for the project! He is a coding fanatic and loves all things tech. Lover of coffee and donuts. Computer Science student at De Montfort University.
				His full set of skills include; HTML, CSS, PHP (incl. Laravel) and Js(incl. jQuery).</p>
			</div>
			<div class="clear"></div>
		</div>
		<div class="team-member odd-child-team-member">
			<div class="team-member-image">
				<img src="/img/temp.png">
			</div>
			<div class="team-member-text">
				<h2>Designer</h2>
				<h1>Jamie Whittaker</h1>
				<p>Jamie is the resident designer helping shape up the look of the dashboard by completing the final touches to make it stand out and user friendly. Avid musician, both using digital software (like fruity loops) and the guitar! He loves some maccies after a night out (who doesn't?) and is a Computer Science student at De Montfort University.</p>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</section>

	@include('partials.staticpages.footer')

@endsection