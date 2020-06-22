@extends('partials.staticpages.master')

@section('content')

    @include('partials.staticpages.header')
  		
	<section>
		<div id="home" class="centre-content">
			<div class="left-column-40">
				<img id="dash-screenshot" src="/img/dash-screenshot.png">
			</div>
			<div class="right-column-60">
				<h1>Uni Made Easy</h1>
				<h2>Well kinda...</h2>
				<p>When you need to store notes, keep track of assignments, make a quick note of something todo, maybe manage your money? YuniHelper's got you covered.</p>
				<a href="/register" class="home-buttons">Sign Up</a>
				<a href="/aboutus" class="home-buttons">Find out more</a>
				<p style="font-size: 1.2em;">Already signed up? <a href="/login" style="color: #2980b9; text-decoration: underline;">Sign In</a></p>
			</div>
		</div>
	</section>
	<section id="about-section">
		<div id="about" class="centre-content">
			<h1 class="text-centre">Be some of the first!</h1>
			<p class="text-centre">Set the trend! See why students have adapted to YuniHelper and made it part of their daily lives.</p>
			<br>
			<p class="text-centre" style="margin: 0;"><a id="discover-button" class="home-buttons" href="/aboutus">About Us</a></p>
		</div>
	</section>
	<section id="testimonials-section">
		<div id="testimonials" class="centre-content">
			<h1 class="text-centre">See what our users have to say!</h1>
			<div class="testimonial">
				<p>Yunihelper is the app that students have been waiting for. It’s so easy to use. Everything you need to think about while you’re a student can be organised on one website which saves so much stress. Other students who study at a lower level could use it too. It appeals to everyone who is in any form of education</p>
				<p class="testimonee">@ceerysss, Cerys Abbott De Montfort University</p>
			</div>
			<div class="testimonial">
				<p>Extremely elegant solution to the problems of many students. Easy to use and great development team which are responsive. Tremendously helpful and lets me keep everything in one place, and keep myself on track!</p>
				<p class="testimonee align-left">@teper_dawid, Dawid Teper, University of Hertfordshire</p>
			</div>
			<div class="testimonial">
				<p>Very easy to use and helpful. Would highly reccomend as a way to keep your uni life organised and structured. 5 stars.</p>
				<p class="testimonee">@mimkime, Miriam Kime, De Montfort University</p>
			</div>
		</div>
	</section>
  @include('partials.staticpages.footer')  
@endsection
