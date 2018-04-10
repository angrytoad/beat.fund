<div class="is_product_in_cart_alert">
    @if(null !== $product && session()->exists('cart'))
        @if(array_key_exists($product->id,session()->get('cart')))
            <div class="alert alert-success">
                {{ $product->name }} is currently in your cart (&pound;{{ number_format(session()->get('cart.'.$product->id)['price']/100,2) }}). <a href="{{ route('storefront.cart') }}">View Cart.</a>
            </div>
        @endif
    @endif
</div>