<header class="divider-color">
  <div id="inner-header">
    <div class="brand">
      <a href="/" id="logo-hover"><h1 class="brand-text text-primary-color"><i class="fa fa-graduation-cap"></i> YuniHelper</h1></a>
    </div>
    <nav>
      <a href="/" class="header-nav-item">Home</a>
      @if (Auth::check())
        <p class="text-primary-color header-nav-item">Welcome back, {{Auth::user()->firstname}}!</p>
        <a href="/dashboard" class="header-nav-item">Dashboard</a>
      @else
        <a href="/login" class="header-nav-item">Sign In</a>
      @endif
      @if (Auth::check())
        <a href="/logout" class="header-nav-item"><i class="fa fa-power-off"></i></a>
      @endif
    </nav>
    <i class="fa fa-bars fa-2x" id="mobile-nav-button"></i>
  </div>
</header>
<div id="mobile-nav">
  <ul>
    @if (Auth::check())
      <li class="text-primary-color header-nav-item">Welcome back, {{Auth::user()->firstname}}!</li>
      <li><a href="/dashboard" class="header-nav-item">Dashboard</a></li>
    @else
      <li><a href="/login" class="header-nav-item">Sign In</a></li>
    @endif
    <li><a href="/" class="header-nav-item">Home</a></li>
    @if (Auth::check())
      <li><a href="/logout" class="header-nav-item">Logout</a></li>
    @endif
  </ul>
</div>