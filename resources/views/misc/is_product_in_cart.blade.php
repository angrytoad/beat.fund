<div class="is_product_in_cart">
    @if(null !== $product && session()->exists('cart'))
        @if(array_key_exists($product->id,session()->get('cart')))
            <form method="POST" action="{{ route('artist.store.product.remove_from_cart',[$product->store->slug,$product->id]) }}">
                {{ csrf_field() }}
                <button class="btn btn-default">Remove from Cart</button>
            </form>
        @else
            <button class="btn btn-success" onclick="$('#add-to-cart').submit()">Add to Cart</button>
        @endif
    @else
        <button class="btn btn-success" onclick="$('#add-to-cart').submit()">Add to Cart</button>
    @endif
</div>