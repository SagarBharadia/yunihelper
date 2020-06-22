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

        <form id="login-form" method="POST" action="/login">
          {{ csrf_field() }}
          <h1>Sign In</h1>
          <p>All entries are case sensitive (yes including the email). Please ensure they are correct.</p>
          <input type="text" value="{{ old('email') }}" placeholder="Email" name="email" id="email" autocomplete="off" required>
          <input type="password" placeholder="Password" name="password" id="password" autocomplete="off" required>
          <button class="divider-color" type='submit'>Login</button>
          <p><a href="/register" class="primary-text-color">Not a member?</a>
          <a href="/forgotpassword" class="primary-text-color">Forgot password?</a></p>   
        </form>

        @include('partials.staticpages.errors')

    </div>

  </div>
@endsection
