<div id="search_and_cart">
    <form method="GET" action="{{ route('storefront.tickets.search') }}">
        <input type="text" name="search" placeholder="Search the for tickets..." autofocus />
    </form>
    <div id="cart_widget">
        <a id="cart_widget_count" href="{{ route('storefront.tickets.cart') }}" title="View my cart">
            <div>
                <i class="fas fa-ticket-alt"></i>
                {{ count($ticket_cart['tickets']) }}
            </div>
        </a>
        <div id="cart_widget_total">
            &pound;{{ number_format($ticket_cart['total']/100,2) }}
        </div>
    </div>
</div>