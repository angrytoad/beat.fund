<ul class="list-group">
    <li class="list-group-item {{ Helper::isActiveRoute('home') }}">
        <a class="list-group-item-heading" href="{{ route('home') }}">Home</a>
    </li>
    <li class="list-group-item {{ Helper::areActiveRoutes(['profile','profile.create']) }}">
        <a href="#" class="dropdown-toggle list-group-item-heading" data-toggle="dropdown" role="button" aria-expanded="false">
            Profile <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li class="{{ Helper::isActiveRoute('profile') }}"><a href="{{ route('profile') }}">Profile</a></li>
        </ul>
    </li>
</ul>
<ul class="list-group">
    <li class="list-group-item dropdown {{ Helper::areActiveRoutes(['account','account.update_email','account.change_password','account.add_mobile_number']) }}">
        <a href="#" class="dropdown-toggle list-group-item-heading" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ Auth::user()->first_name }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li class="{{ Helper::isActiveRoute('account') }}"><a href="{{ route('account') }}">Account</a></li>
            <li class="{{ Helper::isActiveRoute('account.update_email') }}"><a href="{{ route('account.update_email') }}">Update Email</a></li>
            <li class="{{ Helper::isActiveRoute('account.change_password') }}"><a href="{{ route('account.change_password') }}">Change Password</a></li>
            <li class="{{ Helper::isActiveRoute('account.add_mobile_number') }}"><a href="{{ route('account.add_mobile_number') }}">Add/Change a Mobile Number</a></li>
            <hr />
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
        </ul>
    </li>
</ul>