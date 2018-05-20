<h4>
    We have found <strong>{{ count($search_results) }}</strong> result(s) matching your search <strong>"{{ $search }}"</strong>. <a href="{{ route('storefront') }}">Back to Store</a>
</h4>
<div id="search_results">
    @foreach($search_results as $search_result)
        <a href="{{ route('artist.store.product',[$search_result->store_slug, $search_result->id]) }}">
            <div class="search_result"
                 @if($search_result->image_url)
                 style="background:url({{ $search_result->downsizedImage() }});"
                 @else
                 style="background:url('/images/storefront/storefront_no_product_image.jpg');"
                    @endif
            >
                <div class="search_result_name">
                    <div class="name">{{ $search_result->name }}</div>
                    <div class="artist"><strong>By {{ $search_result->artist_name }}</strong> |
                        @if($search_result->price === null)
                            PWYW
                        @else
                            @if($search_result->price === 0)
                                &pound;FREE
                            @else
                                &pound;{{ number_format($search_result->price/100,2) }}
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>