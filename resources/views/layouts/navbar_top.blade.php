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
            @if(Auth::user()->label)
                <a class="navbar-brand" href="{{ route('label.dashboard') }}">
                    <span class="beat">Beat</span> <span class="fund">Fund</span> <span class="divider">|</span> <span class="small">Supporting independent artists.</span>
                </a>
            @else
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="beat">Beat</span> <span class="fund">Fund</span> <span class="divider">|</span> <span class="small">Supporting independent artists.</span>
                </a>
            @endif

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul id="navbar-top-right" class="nav navbar-nav navbar-right">
                <li class="{{ \App\Helpers\Helper::areActiveRoutes(['storefront','storefront.search']) }}"><a href="{{ route('storefront') }}">Store</a></li>
                @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    @if(Auth::user()->label)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <strong>{{ Auth::user()->label->name }} <span class="caret"></span></strong>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('label.dashboard') }}">
                                        Dashboard
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
                                <li>
                                    <a href="{{ route('purchases') }}">
                                        My Purchases
                                    </a>
                                </li>
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
                    @endif

                @endguest
                <li id="cart-menu-item" class="{{ \App\Helpers\Helper::areActiveRoutes(['storefront.cart']) }}">
                    <a href="{{ route('storefront.cart') }}" title="View your music cart">
                        @if(session()->exists('cart'))
                            <i class="fas fa-shopping-cart"></i>
                            {{ count(session()->get('cart')) }}
                        @else
                            <i class="fas fa-shopping-cart"></i>
                            0
                        @endif
                    </a>
                </li>
                <li id="cart-menu-item" class="{{ \App\Helpers\Helper::areActiveRoutes(['storefront.tickets.cart']) }}">
                    <a href="{{ route('storefront.tickets.cart') }}" title="View your tickets cart">
                        @if(session()->exists('ticket_cart'))
                            <i class="fas fa-ticket-alt"></i>
                            {{ count(session()->get('ticket_cart')) }}
                        @else
                            <i class="fas fa-ticket-alt"></i>
                            0
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>