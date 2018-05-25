@extends('layouts.app')

@section('title', 'Tickets')

@section('content')
<div id="tickets" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store.tickets') }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Tickets</div>
                <div class="panel-body">
                    @if(!$user->ticket_store)
                        <div class="alert alert-warning">You do not currently have an enabled Ticket store, please enable it below...</div>
                    @else
                        @if(!$user->ticket_store->live)
                            <div class="alert alert-warning">Your ticket store is not currently live, no tickets can be sold.</div>
                        @else
                            <div class="alert alert-warning">Your ticket store is live, tickets can be sold.</div>
                        @endif
                    @endif
                    <div id="ticket-store-requirements">
                        <div>
                            @if($user->profile->getCompletionPercentage() === 100)
                                <div>
                                    <i class="fas fa-check text-primary"></i>
                                    <p>Have a complete profile <a href="{{ route('profile') }}">Update.</a></p>
                                </div>
                            @else
                                <div>
                                    <i class="fas fa-times text-danger"></i>
                                    <p>You do not have a complete profile ({{ $user->profile->getCompletionPercentage() }}%). <a href="{{ route('profile') }}">Update.</a></p>
                                </div>
                            @endif
                        </div>
                        <div>
                            @if(Auth::user()->stripe_account)
                                <div>
                                    <i class="fas fa-check text-primary"></i>
                                    <p>You have a Stripe Account. <a href="{{ route('account.stripe') }}">Update it.</a></p>
                                </div>
                            @else
                                <div>
                                    <i class="fas fa-times text-danger"></i>
                                    <p>You are not set up to take payments via Stripe. <a href="{{ route('account.stripe') }}">Set up Stripe Account.</a></p>
                                </div>
                            @endif
                        </div>
                        <div>
                            @if(!$user->ticket_store)
                                <a href="{{ route('store.tickets.enable') }}">
                                    <button class="btn btn-primary">Enable Ticket Store</button>
                                </a>
                            @else
                                <div>
                                    <i class="fas fa-check text-primary"></i>
                                    <p>You have enabled your Ticket store.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <hr />
                    <div>
                        @if($user->ticket_store)
                            <h3 class="text-center">
                                {{ $user->first_name }}'s Ticket Store <i class="fas fa-ticket-alt"></i>
                                @if($user->ticket_store->live)
                                    &nbsp;<span class="text-success">(LIVE)</span>
                                @else
                                    &nbsp;<span class="text-danger">(NOT LIVE)</span>
                                @endif
                            </h3>
                            <hr />
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <p>
                                        Set up a new gig or event, and allow the public purchase tickets from you.
                                    </p>
                                    <a href="{{ route('store.tickets.create') }}">
                                        <button class="btn btn-primary">Create Tickets</button>
                                    </a>
                                    <hr />
                                </div>
                                <div class="col-md-4 text-center">
                                    <p>
                                        View all current tickets you have created for gigs and events.
                                    </p>
                                    <a href="{{ route('store.tickets.all') }}">
                                        <button class="btn btn-primary">View Tickets</button>
                                    </a>
                                    <hr />
                                </div>
                                <div class="col-md-4 text-center">
                                    <p>
                                        Look at overall ticket sales across the entire store as well as attendance.
                                    </p>
                                    <button class="btn btn-primary disabled">Ticket Stats</button>
                                    <hr />
                                </div>
                            </div>
                        @endif
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