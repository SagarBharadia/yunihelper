<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
    <meta charset="utf-8">
    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-8714096920931603",
        enable_page_level_ads: true
      });
    </script>
    @if (@isset($title))
      <title>{{ $title }}</title>
    @else
      <title>YuniHelper</title>
    @endif
    <link rel="stylesheet" href="/css/staticpages.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div>
      @yield('content')
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#mobile-nav-button').on('click', function() {
          
          visible = $('#mobile-nav').is(":visible");

          if (visible) {
            $('#mobile-nav').fadeOut('fast');
            $('#mobile-nav-button').css('display', 'none');
            $('#mobile-nav-button').removeClass('fa-times');
            $('#mobile-nav-button').addClass('fa-bars');
            $('#mobile-nav-button').fadeIn();
          } else {
            $('#mobile-nav').fadeIn('fast');
            $('#mobile-nav-button').css('display', 'none');
            $('#mobile-nav-button').removeClass('fa-bars');
            $('#mobile-nav-button').addClass('fa-times');
            $('#mobile-nav-button').fadeIn();
          }
        });
      });
    </script>
  </body>
</html>
