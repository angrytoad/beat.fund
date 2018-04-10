<nav id="navbar-top" class="navbar navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <span class="beat">Beat</span> <span class="fund">Fund</span> <span class="divider">|</span> <span class="small">Supporting independent artists.</span>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul id="navbar-top-right" class="nav navbar-nav navbar-right">
                <li class="{{ \App\Helpers\Helper::areActiveRoutes(['storefront']) }}"><a href="{{ route('storefront') }}">Store</a></li>
                @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->first_name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('home') }}">
                                    Home
                                </a>
                            </li>
                            @if(Auth::user()->profile)
                                <li>
                                    <a href="{{ route('profile') }}">
                                        Profile
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user()->store)
                                <li>
                                    <a href="{{ route('store') }}">
                                        My Store
                                    </a>
                                </li>
                            @endif
                            <hr />
                            <li>
                                <a href="{{ route('account') }}">
                                    Account
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
                <li id="cart-menu-item" class="{{ \App\Helpers\Helper::areActiveRoutes(['storefront.cart']) }}">
                    <a href="{{ route('storefront.cart') }}">
                        @if(session()->exists('cart'))
                            <i class="fas fa-shopping-cart"></i>
                            {{ count(session()->get('cart')) }}
                        @else
                            <i class="fas fa-shopping-cart"></i>
                            0
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>