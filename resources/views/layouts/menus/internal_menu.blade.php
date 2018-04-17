@if(Auth::user())
    <ul id="internal_menu" class="list-group">
        <li class="list-group-item {{ Helper::isActiveRoute('home') }}">
            <a class="list-group-item-heading" href="{{ route('home') }}">Home</a>
        </li>
        <li class="list-group-item {{ Helper::areActiveRoutes(['purchases','purchases.order']) }}">
            <a class="list-group-item-heading" href="{{ route('purchases') }}">
                My Purchases
            </a>
        </li>
        @if(Auth::user()->store)
            <li class="list-group-item {{ Helper::areActiveRoutes([
            'store',
            'store.create',
            'store.products',
            'store.products.product',
            'store.products.create',
            'store.products.product.add_items',
            'store.products.product.rearrange_items',
            'store.products.product.tag_items',
            'store.products.product.item',
            'store.products.product.item.delete',
            ]) }}">
                <a href="#" class="dropdown-toggle list-group-item-heading" data-toggle="dropdown" role="button" aria-expanded="false">
                    My Store <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    @if(Auth::user()->store)
                    <li class="{{ Helper::isActiveRoute('store') }}">
                        <a href="{{ route('store') }}">My Store</a>
                    </li>
                    <li class="{{ Helper::areActiveRoutes([
                    'store.products',
                    'store.products.product',
                    'store.products.create',
                    'store.products.product.add_items',
                    'store.products.product.rearrange_items',
                    'store.products.product.tag_items',
                    'store.products.product.item',
                    'store.products.product.item.delete',
                    ]) }}">
                        <a href="{{ route('store.products') }}">Products</a>
                    </li>
                    @endif
                    @if(Auth::user()->store === null)
                        <li class="{{ Helper::isActiveRoute('store.create') }}"><a href="{{ route('store.create') }}">Create a store</a></li>
                    @endif
                </ul>
            </li>
        @endif
        @if(Auth::user()->profile)
            <li class="list-group-item {{ Helper::areActiveRoutes(['profile','profile.create']) }}">
                <a href="#" class="dropdown-toggle list-group-item-heading" data-toggle="dropdown" role="button" aria-expanded="false">
                    Profile <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li class="{{ Helper::isActiveRoute('profile') }}"><a href="{{ route('profile') }}">Profile</a></li>
                </ul>
            </li>
        @endif
    </ul>
    <ul id="internal_account_menu" class="list-group">
        <li class="list-group-item dropdown {{ Helper::areActiveRoutes([
        'account',
        'account.update_email',
        'account.change_password',
        'account.add_mobile_number',
        'account.stripe',
        'account.stripe.connect',
        'account.cards',
        'account.cards.card'
        ]) }}">
            <a href="#" class="dropdown-toggle list-group-item-heading" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->first_name }}'s Account <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li class="{{ Helper::isActiveRoute('account') }}"><a href="{{ route('account') }}">Account</a></li>
                <li class="{{ Helper::isActiveRoute('account.update_email') }}"><a href="{{ route('account.update_email') }}">Update Email</a></li>
                <li class="{{ Helper::isActiveRoute('account.change_password') }}"><a href="{{ route('account.change_password') }}">Change Password</a></li>
                <li class="{{ Helper::isActiveRoute('account.add_mobile_number') }}"><a href="{{ route('account.add_mobile_number') }}">Add/Change a Mobile Number</a></li>
                <li class="{{ Helper::areActiveRoutes(['account.cards','account.cards.card']) }}"><a href="{{ route('account.cards') }}">My Cards</a></li>
                @if(Auth::user()->stripe_account)
                    <li class="{{ Helper::areActiveRoutes(['account.stripe','account.stripe.connect']) }}"><a href="{{ route('account.stripe') }}">Merchant Account</a></li>
                @else
                    <li class="{{ Helper::areActiveRoutes(['account.stripe','account.stripe.connect']) }}"><a href="{{ route('account.stripe') }}">Create a Merchant Account</a></li>
                @endif

                <hr />
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            </ul>
        </li>
    </ul>
@endif
