<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="/">SCM Bulletin Board</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        @guest
        @if (Route::has('login'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}"></a>
        </li>
        @endif
        @else
        @if (Auth::user()->type == '0') 
          <li class="nav-link"><a href="{{ route('userlist') }}">Users</a></li>
        @endif 
        <li class="nav-link"><a href="/profile">User</a></li>
        <li class="nav-link"><a href="{{ route('postlist') }}">Posts</a></li>
        @endguest
      </ul>
      <ul class="navbar-nav ml-auto">
        @if(isset(Auth::user()->name))
          <li class="nav-link"><a href="#">{{ (Auth::user()->name) }}</a></li>
        @endif
        @guest
        @if (Route::has('logout'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        @endif
        @else
        <li class="nav-link">
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); 
            document.getElementById('logout-form').submit();">Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>