@extends('layouts.app')

@section('title', 'All Tickets')

@section('content')
<div id="all-tickets" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store.tickets.all') }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">All Tickets</div>
                <div class="panel-body">
                    @if(!$ticket_store->live)
                        <div class="alert alert-warning">Your ticket store is NOT LIVE. (Nobody will be able to buy tickets from you.)</div>
                    @else
                        <div class="alert alert-success">This ticket store is currently LIVE. (People can buy tickets from you.)</div>
                    @endif

                    <div class="row">
                        <div class="col-xs-12">
                            <div id="store_tickets_clickthrough">
                                <a href="{{ route('store.tickets.live') }}">
                                    <div title="Live Tickets">
                                        <span>
                                            <i class="fas fa-ticket-alt"></i> <strong>{{ count($live_tickets) }}</strong><br />
                                            <small>Live Tickets</small>
                                        </span>
                                    </div>
                                </a>
                                <a href="{{ route('store.tickets.expired') }}">
                                    <div title="Expired Tickets">
                                        <span>
                                            <i class="far fa-clock"></i> <strong>{{ count($expired_tickets) }}</strong><br />
                                            <small>Expired Tickets</small>
                                        </span>
                                    </div>
                                </a>
                                <a href="{{ route('store.tickets.pending') }}">
                                    <div title="Pending Tickets">
                                        <span>
                                            <i class="fas fa-cubes"></i> <strong>{{ count($pending_tickets) }}</strong><br />
                                            <small>Pending Tickets</small>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <a href="{{ route('store.tickets.create') }}"><button class="btn btn-primary">Create a ticket</button></a>
                        </div>
                    </div>
                    <hr />
                    <h4>Recently Added</h4>
                    <table class="table table-striped table-hover table-responsive" id="ticket_products_recent">
                        <thead class="thead-dark">
                        <tr>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Start</th>
                            <th>End</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                @if($ticket->live)
                                    @if(\Carbon\Carbon::parse($ticket->end)->diffInSeconds(\Carbon\Carbon::now()) < 0)
                                        <td><i class="far fa-clock" title="Ticket Expired"></i></td>
                                    @else
                                        <td><i class="fas fa-ticket-alt" title="Ticket Live"></i></td>
                                    @endif
                                @else
                                    <td><i class="fas fa-cubes" title="Ticket Pending"></i></td>
                                @endif
                                <td>
                                    <a href="{{ route('store.tickets.ticket', $ticket->id) }}">
                                        {{ $ticket->name }}
                                    </a>
                                </td>
                                @if($ticket->price === null)
                                    <td>PWYW</td>
                                @else
                                    @if($ticket->price === 0)
                                        <td>&pound;FREE</td>
                                    @else
                                        <td>&pound;{{ number_format($ticket->price/100, 2) }}</td>
                                    @endif
                                @endif

                                <td>{{ \Carbon\Carbon::parse($ticket->start)->toDayDateTimeString() }}</td>
                                <td>{{ \Carbon\Carbon::parse($ticket->end)->toDayDateTimeString() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready( function () {
            $('#ticket_products_recent').dataTable();
        } );
    </script>
@endsection