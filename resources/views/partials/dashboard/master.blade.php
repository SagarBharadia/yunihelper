<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}"/>
    <title>{{ $title }}</title>
    @yield('cssimports')
    <link rel="stylesheet" href="/css/dashboard.css">
    <script
			  src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-8714096920931603",
        enable_page_level_ads: true
      });
    </script>
  </head>
  <body>
    @include('partials.dashboard.nav')
    <div class="main-body">
      @include('partials.dashboard.header')
      @include('partials.dashboard.ads')
      <div class="content">
        @include('partials.dashboard.errors')
        @include('partials.dashboard.messages')
        @yield('content')
      </div>
    </div>
    <script type="text/javascript">
      $('nav').hover(
        function() {
          if ($('nav').outerWidth()==62) {
            $('nav').animate({width: "200"}, 200);
            $('#navitems span').fadeIn(200);
          }
        },
        function() {
          if ($(window).width() > 900) {
            if ($('nav').outerWidth()>62) {
              $('nav').animate({width: "60"}, 200);
              $('#navitems span').fadeOut(200);
            }
          } else {
            $('nav').animate({width: "0"}, 200);
            $('#navitems span').fadeOut(200);
            $('#mobile-nav-button').removeClass('fa-times');
            $('#mobile-nav-button').addClass('fa-bars');
          }
        }
      );
      $('#mobile-nav-button').on('click', function() {
        if ($('nav').outerWidth()>62) {
          $('nav').animate({width: "0"}, 200);
          $('#navitems span').fadeOut(200);
          $('#mobile-nav-button').removeClass('fa-times');
          $('#mobile-nav-button').addClass('fa-bars');
        } else {
          $('nav').animate({width: "200"}, 200);
          $('#navitems span').fadeIn(200);
          $('#mobile-nav-button').removeClass('fa-bars');
          $('#mobile-nav-button').addClass('fa-times');
        }
      });
      $('.main-body').on('click', function() {
        if ($(window).width() < 900) {
          $('nav').animate({width: "0"}, 200);
          $('#navitems span').fadeOut(200);
          $('#mobile-nav-button').removeClass('fa-times');
          $('#mobile-nav-button').addClass('fa-bars');
        }
      });
      $('textarea').each(function () {
        this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
      }).on('input', function () {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
      });
    </script>
    @yield('jsimports')
  </body>
</html>
