<div id="search_and_cart">
    <form method="GET" action="{{ route('storefront.search') }}">
        <input type="text" name="search" placeholder="Search the store..." autofocus />
    </form>
    <div id="cart_widget">
        <a id="cart_widget_count" href="{{ route('storefront.cart') }}" title="View my cart">
            <div>
                <i class="fas fa-shopping-cart"></i>
                {{ count($cart['products']) }}
            </div>
        </a>
        <div id="cart_widget_total">
            &pound;{{ number_format($cart['total']/100,2) }}
        </div>
    </div>
</div>