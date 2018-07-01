@extends('layouts.app')

@section('title', 'Showing products for '.$search)


@section('content')
    <div id="storefront" class="container">
        @include('layouts.flash_message')
        {{ Breadcrumbs::render('storefront.tickets.search') }}
        <div id="ticket_search_results_wrapper">
            <div id="storefront-picker" class="row hidden-xs">
                <div class="col-xs-12 col-md-6">
                    <a href="{{ route('storefront') }}">
                        <div class="holder">
                            <h2><i class="fas fa-music"></i> The Music Store</h2>
                            <p>
                                Discover amazing new music, find genres you never knew you loved!
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-md-6">
                    <a href="{{ route('storefront.tickets') }}">
                        <div class="holder active">
                            <h2><i class="fas fa-ticket-alt"></i> The Ticket Store</h2>
                            <p>
                                Whats better than listening to your favourite music? Seeing it of course!
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @include('storefront._ticket_storefront_partials.search_and_cart')
            @include('storefront._ticket_storefront_partials.search_results')
        </div>
    </div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection