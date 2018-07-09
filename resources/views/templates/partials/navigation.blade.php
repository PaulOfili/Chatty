<nav class="navbar navbar-default navbar-static-top" role = "navigation">
    <div class = "container">
      <div class='navbar-header'>
        <a class="navbar-brand" href="#">Chatty</a>
        <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar-collapse'>
            <span class='sr-only'>Toggle Navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
        </button>
      </div>

      
      <div class='collapse navbar-collapse' id='navbar-collapse'>
        @if (Auth::check())
            <ul class="nav navbar-nav" style = "padding-left:25px">
                <li>
                    <a href="{{ route('home')}}">Timeline</a>
                </li>
                <li>
                    <a href="{{ route('friends.index')}}">Friendss </a> </i>
                </li>
                
            </ul>
            <form role = "search" action="{{ route('search.results') }}" class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" name="query" placeholder = "Find people" class="form-control">
                </div>
                <button class="btn btn-default" type = "submit">Search</button>
                <!-- <input type="hidden" name="_token" value="{{Session::token()}}"> -->
            </form>
        @endif
        <ul class="nav navbar-nav navbar-right">
        @if (Auth::check())
            <li>
                
                <a href="{{route('profile.index',['username'=> Auth::user()->username])}}">{{Auth::user()->getNameOrUsername()}} </a>
            </li>
            <li>
                <a href="{{route('profile.edit')}}">Update profile</a>
            </li>
            <li>
                <a href="{{route('auth.signout')}}">Sign out</a>
            </li>
        @else
            <li>
                <a href="{{route('auth.signup')}}">Sign up</a>
            </li>
            <li>
                <a href="{{route('auth.signin')}}">Sign in</a>
            </li>
        @endif
        </ul>
      </div>
    </div>
    </nav>