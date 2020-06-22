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

        <form id="forgot-password-form" method="POST" action="/resetpassword">
          {{ csrf_field() }}
          <h1>Reset Password</h1>
          <input type="hidden" value="{{$id}}" id="id" name="id" required>
          <input type="hidden" value="{{$resetPasswordToken}}" id="resetPasswordToken" name="resetPasswordToken" required>
          <input type="password" placeholder="Password" id="password" name="password">
          <input type="password" placeholder="Re Password" id="password_confirmation" name="password_confirmation">
          <button class="divider-color" type='submit'>Reset Password</button>
        </form>

        @include('partials.staticpages.errors')

    </div>

  </div>

@endsection