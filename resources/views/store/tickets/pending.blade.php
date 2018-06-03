@extends('layouts.app')

@section('title', 'Pending Tickets')

@section('content')
    <div id="pending-tickets" class="container">
        @include('layouts.flash_message')
        {{ Breadcrumbs::render('store.tickets.pending') }}
        <div class="row">
            <div class="col-md-3">
                @include('layouts.menus.internal_menu')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Pending Tickets</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div id="pending-tickets-topper">
                                    <div title="Pending Tickets">
                                        <span>
                                            <i class="fas fa-cubes"></i> <strong>{{ count($tickets) }}</strong><br />
                                            <small>Total Pending Tickets</small>
                                        </span>
                                    </div>
                                    <div>
                                        <h2>Pending Tickets</h2>
                                        <p>
                                            Pending tickets are tickets that have been created but are not currently available on
                                            your ticket store, this allows you to pre-create all of the ticket required for each venue
                                            in a tour easily, and only make them available when needed.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <table class="table table-striped table-hover table-responsive" id="ticket_products_recent">
                            <thead class="thead-dark">
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
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
                                    <td>
                                        <a href="{{ route('store.tickets.ticket.delete',$ticket->id) }}">
                                            <i class="fas fa-times text-danger"></i>
                                        </a>
                                    </td>
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