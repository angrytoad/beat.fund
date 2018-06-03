@extends('layouts.app')

@section('title', 'Expired Tickets')

@section('content')
    <div id="expired-tickets" class="container">
        @include('layouts.flash_message')
        {{ Breadcrumbs::render('store.tickets.expired') }}
        <div class="row">
            <div class="col-md-3">
                @include('layouts.menus.internal_menu')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Expired Tickets</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div id="expired-tickets-topper">
                                    <div title="Expired Tickets">
                                        <span>
                                            <i class="fas fa-clock"></i> <strong>{{ count($tickets) }}</strong><br />
                                            <small>Total Expired Tickets</small>
                                        </span>
                                    </div>
                                    <div>
                                        <h2>Expired Tickets</h2>
                                        <p>
                                            Expired tickets are tickets that have been on sale BUT are not longer available
                                            because the event they were created for has ended, customers will no longer be able to
                                            use these tickets to "Check in" at the event.
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