<div id="recently_added_tickets">
    @foreach($recent_tickets as $recent_ticket)
        <a href="{{ route('storefront.tickets.ticket',[$recent_ticket->slug]) }}">
            <div class="recently_added_ticket"
                 @if($recent_ticket->banner_url)
                 style="background:url({{ $recent_ticket->downsizedBannerImage() }});"
                 @else
                 style="background:url('/images/storefront/storefront_no_product_image.jpg');"
                    @endif
            >
                <div class="recently_added_product_name">
                    <div class="name">{{ $recent_ticket->name }}</div>
                    <div class="artist"><strong>By {{ $recent_ticket->artist_name }}</strong> |
                        @if($recent_ticket->price === null)
                            PWYW
                        @else
                            @if($recent_ticket->price === 0)
                                &pound;FREE
                            @else
                                &pound;{{ number_format($recent_ticket->price/100,2) }}
                            @endif

                        @endif

                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>