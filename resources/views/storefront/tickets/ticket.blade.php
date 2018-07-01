@extends('storefront.tickets.layout.app_ticket')

@section('title', $ticket->name)

@section('content')
<br />
<div class="container">
    @if($preview)
        <div class="row">
            <div class="alert alert-warning">
                This ticket page is currently in <strong>PREVIEW MODE</strong>, in order for customers to buy this ticket you must set it live. <br />
                If you would like to edit your ticket you can do so <a href="{{ route('store.tickets.ticket',$ticket->id) }}">Here.</a>
            </div>
        </div>
    @endif
</div>
<div id="ticket" class="container">
    <div class="row" id="ticket-banner">
        <div id="ticket-banner-name">
            <h1>{{ $ticket->name }}</h1>
        </div>
        @if($ticket->banner_key)
            <img id="ticket-banner-image" src="{{ $ticket->downsizedBannerImage() }}" />
        @endif
    </div>
    <hr />
    <div class="row" id="ticket-content">
        <div class="col-xs-12">
            <div class="row">
               <div class="col-md-8">
                   <h1 id="ticket-content-title">
                       {{ $ticket->name }}
                   </h1>
                   <h2 id="ticket-content-title-presented-by">
                       @if($profile->user->store->live)
                           <small>Presented by <a href="{{ route('artist.store', $profile->user->store->slug) }}">{{ $profile->artist_name }}</a></small>
                       @else
                           <small>Presented by <strong>{{ $profile->artist_name }}</strong></small>
                       @endif
                   </h2>
                   <div id="ticket-content-description">
                       {!! $ticket->description !!}
                   </div>
                </div>
                <div class="col-md-4">
                    <div id="ticket-content-price" class="jumbotron">
                        <div>
                            @if($ticket->price === null)
                                <small>Pay what you want</small>
                            @elseif($ticket->price === 0)
                                FREE
                            @else
                                &pound;{{ number_format($ticket->price/100,2) }}
                            @endif
                            <a href="{{ route('storefront.tickets.ticket.buy',$ticket->slug) }}">
                                <button class="btn btn-primary">Buy Tickets</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div id="ticket-times" class="row">
                <div class="col-md-6">
                    <div class="jumbotron">
                        <p>Starts</p>
                        <h3>{{ \Carbon\Carbon::parse($ticket->start)->toDayDateTimeString() }}</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="jumbotron">
                        <p>Ends</p>
                        <h3>{{ \Carbon\Carbon::parse($ticket->end)->toDayDateTimeString() }}</h3>
                    </div>
                </div>
            </div>
            <hr />
            <div id="ticket-content-location">
                <div class="row">
                    <div class="col-md-4">
                        <h2>Location</h2>
                        <p>
                            This event is located at <strong>{{ $ticket->location }}</strong>
                        </p>
                        <p>
                            To view an interactive version, please click on the map to open it in google maps.
                        </p>
                    </div>
                    <div class="col-md-8">
                        {!! $ticket->getStaticMap() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection