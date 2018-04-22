<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <ul>
                    <a href="{{ route('login') }}"><li>Login</li></a>
                    <a href="{{ route('register') }}"><li>Register</li></a>
                    <a href="{{ route('password.request') }}"><li>Forgotten Your Password?</li></a>
                    <a href="{{ route('store_terms_and_conditions') }}"><li>Terms & Conditions</li></a>
                    <a href="{{ route('privacy_policy') }}"><li>Privacy Policy</li></a>
                    <a href="{{ route('revenue_sharing_policy') }}"><li>Revenue Sharing Policy</li></a>
                </ul>
            </div>
            <div class="col-md-4 col-sm-6">
                <ul>
                    @if(Auth::user())
                        <a href="{{ route('home') }}"><li>Home</li></a>
                        <a href="{{ route('purchases') }}"><li>My Purchases</li></a>
                        <a href="{{ route('account') }}"><li>My Account</li></a>
                        <a href="{{ route('account.cards') }}"><li>My Cards</li></a>
                    @else
                        <a href="{{ route('welcome') }}"><li>Home</li></a>
                    @endif
                    <a href="{{ route('storefront') }}"><li>Store</li></a>
                </ul>
            </div>
            <div class="col-md-4 col-sm-12">
                <div>
                    Why not check us out on social media?
                </div>
                <ul id="footer-social">
                    <li><a href="https://www.instagram.com/beatfund/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                </ul>
                <div>
                    If you need to get in touch directly, you can email: <br /> <a href="mailto:support@beat.fund">support@beat.fund</a>
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