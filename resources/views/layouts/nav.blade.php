<nav id="mynav" class="navbar navbar-expand-lg navbar-dark bg-primary">
  <img style="padding-right:5px;border:1px white solid;margin-right:10px;margin-top:10px;background-color:white;" src="/images/PLSE-Logo-1.png" width="15%" height="auto" /><a style="font-size:1.8em;margin-top:20px;" class="navbar-brand" href="/dashboard">PardonMe™</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div style="margin-top:20px;font-size:1.2em;" class="collapse navbar-collapse" id="mobileMenu">
    <ul class="navbar-nav mr-auto">
      @guest
      @else
      <li class="nav-item {{ set_active('dashboard') }}">
        <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item {{ set_active('help') }}">
        <a class="nav-link" href="{{url('/help')}}">Help</a>
      </li>
      <li class="nav-item {{ set_active('about') }}">
        <a class="nav-link" href="{{url('/about')}}">About</a>
      </li>
      @endguest
    </ul>
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
          <li class="nav-item text-white"><a class="nav-link" href="http://plsephilly.org/">PLSE Info</a></li>
          <!--<li class="nav-item"><span class="nav-link">|</span></li>-->
          <!-- Authentication Links -->
          @guest
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @endif
          @else
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
          @endguest
      </ul>
  </div>
</nav>
