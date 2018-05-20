<div id="recently_added_products">
    @foreach($recent_products as $recent_product)
        <a href="{{ route('artist.store.product',[$recent_product->store_slug, $recent_product->id]) }}">
            <div class="recently_added_product"
                 @if($recent_product->image_url)
                 style="background:url({{ $recent_product->downsizedImage() }});"
                 @else
                 style="background:url('/images/storefront/storefront_no_product_image.jpg');"
                    @endif
            >
                <div class="recently_added_product_name">
                    <div class="name">{{ $recent_product->name }}</div>
                    <div class="artist"><strong>By {{ $recent_product->artist_name }}</strong> |
                        @if($recent_product->price === null)
                            PWYW
                        @else
                            @if($recent_product->price === 0)
                                &pound;FREE
                            @else
                                &pound;{{ number_format($recent_product->price/100,2) }}
                            @endif

                        @endif

                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>