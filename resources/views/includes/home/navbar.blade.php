<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">

      <div class="navbar-header">
        <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon icon-bar"></span>
          <span class="icon icon-bar"></span>
          <span class="icon icon-bar"></span>
        </button>
        <a href="#top" class="navbar-brand smoothScroll">Informatika</a>
      </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="#top" class="smoothScroll"><span>Home</span></a>
            </li>
            @if (Auth::user())
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="smoothScroll" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                </form>
            </li>
            @else
            <li>
                <a href="{{ route('login') }}" class="smoothScroll"><span>Login</span></a>
            </li>
            <li>
            <a href="{{ route('register') }}" class="smoothScroll"><span>Register</span></a>
            </li>
            @endif
          </ul>
       </div>

    </div>
  </div>
