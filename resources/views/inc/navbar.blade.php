<nav class="navbar navbar-light ">
      <div class="container nav-container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Sling It  </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <div class="mobile-nav">
          <ul class="nav navbar-nav ">
            <li class="navbar-searching">
            {!! Form::open(['url' => 'search/submit','class'=> 'navbar-form']) !!}
              <div class="form-group navbar-fill">
                {{Form::text('search', '',['class'=> 'form-control navbar-fill','placeholder'=>'search'])}}
              </div>
              {!! Form::close() !!}
            </li>

            <li class="{{Request::is('contact') ? 'active': ''}} navbar-submit ">
                <form>
                    <input type="button" value="Submit Content"class="btn btn-primary" onclick="window.location.href='/submit'" />
                </form>
            </li>
            <li class="{{Request::is('explore') ? 'active':''}}"><a href="/explore">Explore</a></li>
              @auth
            <li class="dropdown">
              <img src="/storage/avatars/{{ Auth::user()->avatar}}" class="UserNavbarAvatar" alt="user's avatar">
              <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="{{Request::is('profile') ? 'active': ''}}"><a href="/profile/{{Auth::user()->username}}"><i class="glyphicon glyphicon-user navbar-padding"></i>Profile</a></li>
                <li ><a href="/logout"><i class="glyphicon glyphicon-log-out navbar-padding"></i>Logout</a></li>
              </ul>
            </li>
            @else
            <li class="{{Request::is('login') ? 'active': ''}}"><a href="/login">Login</a></li>
            <li class="{{Request::is('register') ? 'active': ''}}"><a href="/register">Register</a></li>
            @endauth

          </ul>
        </div>

          <div class="non-mobile">
          <ul class="nav navbar-nav ">
            <li class="{{Request::is('explore') ? 'active':''}}"><a href="/explore">Explore</a></li>

            <li class="navbar-searching">
            {!! Form::open(['url' => 'search/submit','class'=> 'navbar-form']) !!}
              <div class="form-group navbar-fill">
                {{Form::text('search', '',['class'=> 'form-control navbar-fill','placeholder'=>'search'])}}
              </div>
              {!! Form::close() !!}
            </li>

            <li class="{{Request::is('contact') ? 'active': ''}} navbar-submit ">
                <form>
                    <input type="button" value="Submit Content"class="btn btn-primary" onclick="window.location.href='/submit'" />
                </form>
            </li>

              @auth
            <li class="dropdown navbar-right">
              <img src="/storage/avatars/{{ Auth::user()->avatar}}" class="UserNavbarAvatar" alt="user's avatar">
              <a href="#" class="dropdown-toggle navbar-right" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="{{Request::is('profile') ? 'active': ''}}"><a href="/profile/{{Auth::user()->username}}"><i class="glyphicon glyphicon-user navbar-padding"></i>Profile</a></li>
                <li ><a href="/logout"><i class="glyphicon glyphicon-log-out navbar-padding"></i>Logout</a></li>
              </ul>
            </li>
            @else
            <li class="{{Request::is('login') ? 'active': ''}}"><a href="/login">Login</a></li>
            <li class="{{Request::is('register') ? 'active': ''}}"><a href="/register">Register</a></li>
            @endauth
          </ul>
        </div>


        </div><!--/.nav-collapse -->
      </div>
    </nav>
