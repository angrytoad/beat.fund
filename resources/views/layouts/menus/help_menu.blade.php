@if(Auth::user())
    <ul id="internal_menu" class="list-group">
        <li class="list-group-item">
            <div class="list-group-item-heading"><h4>Documentation</h4></div>
        </li>
        <li class="list-group-item {{ Helper::areActiveRoutes(['help.store','help.store.products','help.store.products.pricing']) }}">
            <a class="list-group-item-heading" href="{{ route('help.store.products.pricing') }}">Product Pricing</a>
        </li>
    </ul>
@endif
