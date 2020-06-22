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

        <form id="forgot-password-form" method="POST" action="/forgotpassword">
          {{ csrf_field() }}
          <h1>Forgot Password</h1>
          <input type="text" placeholder="Email" name="email" id="email" required>
          <button class="divider-color" type='submit'>Reset Password</button>
        </form>

        @include('partials.staticpages.errors')

    </div>

  </div>

@endsection