@extends('layouts.app')

@section('title', 'Live Tickets')

@section('content')
<div id="live-tickets" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store.tickets.live') }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Live Tickets</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div id="live-tickets-topper">
                                <div title="Live Tickets">
                                        <span>
                                            <i class="fas fa-ticket-alt"></i> <strong>{{ count($tickets) }}</strong><br />
                                            <small>Total Live Tickets</small>
                                        </span>
                                </div>
                                <div>
                                    <h2>Live Tickets</h2>
                                    <p>
                                        Live tickets are purchasable from the store and available to use by customers to "Check in" to events.
                                        When a ticket passes it end time, it is then set as expired, a ticket that has expired will no longer be
                                        available to purchase on the store and also no longer editable.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
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