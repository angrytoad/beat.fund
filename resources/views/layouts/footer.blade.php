<div id="footer">
    <div class="container">
        <div class="row">
            <div id="footer-store-wrap" class="col-xs-12 col-sm-12 col-md-9">
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Thanks for checking out Beat Fund, why not have a browse around while your here?</h4>
                        <div id="footer-store-buttons">
                            <a href="{{ route('storefront') }}">
                                <button class="btn btn-default">Music Store</button>
                            </a>
                            <a href="{{ route('storefront.tickets') }}">
                                <button class="btn btn-default">Tickets Store</button>
                            </a>
                            <a href="{{ route('storefront.cart') }}">
                                <button class="btn btn-primary">
                                    @if(session()->exists('cart'))
                                        <i class="fas fa-shopping-cart"></i>
                                        {{ count(session()->get('cart')) }}
                                    @else
                                        <i class="fas fa-shopping-cart"></i>
                                        0
                                    @endif
                                </button>
                            </a>
                            <a href="{{ route('storefront.tickets.cart') }}" title="View your tickets cart">
                                <button class="btn btn-primary">
                                    @if(session()->exists('ticket_cart'))
                                        <i class="fas fa-ticket-alt"></i>
                                        {{ count(session()->get('ticket_cart')) }}
                                    @else
                                        <i class="fas fa-ticket-alt"></i>
                                        0
                                    @endif
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <h4>Got a suggestion?</h4>
                <a href="{{ route('suggest_a_feature') }}">
                    <button class="btn btn-info">Suggest a feature</button>
                </a>
            </div>
        </div>
        <div class="col-xs-12">
            <hr />
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <h4>Site Links</h4>
                <ul>
                    @if(Auth::user())
                        <a href="{{ route('account.update_email') }}"><li>Update Your Email</li></a>
                        <a href="{{ route('account.change_password') }}"><li>Change Your Password</li></a>
                        <a href="{{ route('account.add_mobile_number') }}"><li>Change Your Mobile</li></a>
                    @else
                        <a href="{{ route('login') }}"><li>Login</li></a>
                        <a href="{{ route('register') }}"><li>Register</li></a>
                        <a href="{{ route('password.request') }}"><li>Forgotten Your Password?</li></a>
                    @endif
                    <a target="_blank" href="https://termsfeed.com/terms-conditions/c26e18e24eb4e014fc316451d02c19ca"><li>Terms & Conditions</li></a>
                    <a target="_blank" href="https://www.iubenda.com/privacy-policy/85876449"><li>Privacy Policy</li></a>
                    <a href="{{ route('revenue_sharing_policy') }}"><li>Revenue Sharing Policy</li></a>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6">
                <h4>&nbsp;</h4>
                <ul>
                    @if(Auth::user())
                        <a href="{{ route('home') }}"><li>Dashboard</li></a>
                        <a href="{{ route('purchases') }}"><li>My Purchases</li></a>
                        <a href="{{ route('account') }}"><li>My Account</li></a>
                        <a href="{{ route('account.cards') }}"><li>My Cards</li></a>
                    @else
                        <a href="{{ route('welcome') }}"><li>Home</li></a>
                    @endif
                    <a href="{{ route('storefront') }}"><li>Music Store</li></a>
                    <a href="{{ route('storefront.tickets') }}"><li>Ticket Store</li></a>
                    <a href="{{ route('beatfund_for_artists') }}"><li>Beat Fund for Artists</li></a>
                    <a href="{{ route('beatfund_for_labels') }}"><li>Beat Fund for Labels</li></a>
                </ul>
            </div>
            <div class="col-xs-12 hidden-md hidden-lg">
                <hr class="hidden-md hidden-lg" />
            </div>
            <div class="col-md-3 col-sm-12">
                <h4>External Links</h4>
                <ul>
                    <a target="_blank" href="https://app.metriclist.com/u/beatfund">
                        <li>Metriclist</li>
                    </a>
                    <a target="_blank" href="https://open.spotify.com/user/duenna/playlist/0yXzk5Fv0tAt7qy2N7bFFy?si=i-MfLhiIQZGF56Y6ilFPnw">
                        <li>Beat Fund - Essentials (Spotify)</li>
                    </a>
                </ul>
            </div>
            <div class="col-xs-12 hidden-md hidden-lg">
                <hr class="hidden-md hidden-lg" />
            </div>
            <div class="col-md-3 col-sm-12">
                <div>
                    Why not check us out on social media?
                </div>
                <ul id="footer-social">
                    <li><a href="https://www.instagram.com/beatfund/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://www.facebook.com/BeatFundStore" target="_blank"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="https://open.spotify.com/user/duenna/playlist/0yXzk5Fv0tAt7qy2N7bFFy?si=eTzx6770TRyJIBLT0mfe6A" target="_blank"><i class="fab fa-spotify"></i></a></li>
                </ul>
                <div>
                    If you need to get in touch directly, you can email: <br /> <a href="mailto:tom@beat.fund">tom@beat.fund</a>
                </div>
            </div>
        </div>

    </div>
</div>
<div id="footer-copyright">
    <div class="container text-center">
        &copy; {{  \Carbon\Carbon::now()->year }} Beat Fund
    </div>
</div>