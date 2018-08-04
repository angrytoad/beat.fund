<div id="side_menu">
    <h3 class="text-muted">{{ Auth::user()->label->name }}</h3>
    <hr />
    <div class="side_menu_segment">
        <div class="list-group">
            <div class="list-group-item">
                <h3 class="text-muted">Artists/Bands</h3>
                <ul>
                    <li>
                        <input class="form-control" type="text" placeholder="Artist quick search..." />
                    </li>
                    <hr />
                    <li class="disabled">
                        View all artists
                    </li>
                    <li class="disabled">
                        Create an artist
                    </li>
                    <li class="disabled">
                        Artist analytics
                    </li>
                    <hr />
                    <li class="disabled">
                        Payouts manager
                    </li>
                    <li class="disabled">
                        Settings
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="side_menu_segment">
        <div class="list-group">
            <div class="list-group-item">
                <h3 class="text-muted">Organisation</h3>
                <ul>
                    <a href="{{ route('label.dashboard') }}">
                        <li>
                            Dashboard
                        </li>
                    </a>
                    <hr />
                    <a href="{{ route('label.organisation.user_manager') }}">
                        <li>
                            User manager
                        </li>
                    </a>
                    <li class="disabled">
                        User analytics
                    </li>
                    <a href="{{ route('label.organisation.user_manager.create_user') }}">
                        <li>
                            Create a user
                        </li>
                    </a>

                    <hr />
                    <li class="disabled">
                        Role manager
                    </li>
                    <hr />
                    <li class="disabled">
                        Payment settings
                    </li>
                    <li class="disabled">
                        Add a card
                    </li>
                    <hr />
                    <li class="disabled">
                        Support
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <div class="side_menu_segment">
        <div class="list-group">
            <div class="list-group-item">
                <h3 class="text-muted">My Account</h3>
                <ul>
                    <li class="disabled">
                        Change email address
                    </li>
                    <hr />
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <li>
                            Logout
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</div>