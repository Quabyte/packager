<nav class="navbar navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand-custom" href="{{ url('/') }}">
                <img src="{{ asset('images/deturlogo.png') }}" alt="" class="img-responsive" style="max-width: 80%;">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @if(Auth::check() && Auth::user()->isAdmin())
                    <li>
                        <a href="{{ action('DashboardController@index') }}">Dashboard</a>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <p class="navbar-text">
                        <a href="{{ asset('misc/VIP.pdf') }}" target="_blank">
                            Interested in VIP Packages?
                        </a>
                    </p>
                </li>
                @if (Auth::guest())
                    <li><a href="{{ url('/register') }}">REGISTER</a></li>
                    <li><a href="{{ url('/login') }}">LOGIN</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
                <li>
                    <a href="#" class="custom-navbar-a">
                        <i class="icon pe-3x pe-cart"></i>
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>