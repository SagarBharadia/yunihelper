@extends('partials.staticpages.master')

@section('content')
  <div class="register-left">
    <div class="register-left-inner">
      <div>
        <a href="/"><h1 class="text-primary-color register-brand"><i class="fa fa-graduation-cap"></i> YuniHelper</h1></a>
      </div>
      <div class="register-slogan">
        <h1 class="text-primary-color to-be-changed">Redefining the university experience</h1>
      </div>
    </div>
  </div>
  <div class="register-right">

      <div class="register-right-auth-box">

          <form id="register-form" method="POST" action="/register">
            {{ csrf_field() }}
            <h1>Sign Up</h1>
            <p>All entries are case sensitive (yes including the email). Please ensure they are correct.</p>
            <p>By registering to use this service you accept to the privacy policy <a href="/privacypolicy">here</a>.</p>
            <input type="text" placeholder="First Name" name="firstname" id="firstname" autocomplete="off" value="{{ old('firstname') }}" required>
            <input type="text" placeholder="Last Name" name="lastname" id="lastname" autocomplete="off" value="{{ old('lastname') }}" required>
            <input type="text" placeholder="Username" name="username" id="username" autocomplete="off" value="{{ old('username') }}" required>
            <input type="email" placeholder="Email" name="email" id="email" autocomplete="off" value="{{ old('email') }}" required>
            <input type="email" placeholder="Re Email" name="email_confirmation" id="email_confirmation" autocomplete="off" value="{{ old('email_confirmation') }}" required>
            <input type="password" placeholder="Password" name="password" id="password" autocomplete="off" required>
            <input type="password" placeholder="Re Password" name="password_confirmation" autocomplete="off" id="password_confirmation" required>
            <button type='submit'>Register</button>
            <a href="/login" class="primary-text-color">Already Member?</a>
          </form>

          @include('partials.staticpages.errors')

      </div>

  </div>
@endsection
