@extends('storefront.tickets.layout.app_ticket')

@section('title', 'Buy tickets for '.$ticket->name)

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
    <div id="buy-ticket" class="container">
        <div class="row" id="ticket-banner">
            <div id="ticket-banner-name">
                <h1>{{ $ticket->name }}</h1>
            </div>
            @if($ticket->banner_key)
                <img id="ticket-banner-image" src="{{ $ticket->downsizedBannerImage() }}" />
            @endif
        </div>
        <hr />
        @include('layouts.flash_message')
        <div class="row" id="ticket-content">
            <div id="ticket-counter" class="col-xs-12">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="ticket-title">Step 1.</h2>
                        <h2 class="ticket-subtitle"><small>Select the number of tickets you want.</small></h2>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <p>
                            Please remember that when buying tickets through Beat Fund, they are non-transferrable between users.
                            Your digital ticket will be sent via email and you will need to have access to that email when you visit
                            the venue.
                        </p>
                        <p>
                            If for some reason you lose your digital ticket, you can use our ticket recovery tool, in order to use this tool
                            you will need to <strong>note down your ticket reference number.</strong>
                        </p>
                        <div id="ticket-counter-wrap">
                            I would like <div id="buy-ticket-counter">
                                <div id="buy-ticket-counter-decrement">
                                    <i class="fas fa-minus" onclick="removeAttendee()"></i>
                                </div>
                                <div id="buy-ticket-counter-total" onclick="customAttendeeNumber()">1</div>
                                <div id="buy-ticket-counter-increment">
                                    <i class="fas fa-plus" onclick="addAttendee()"></i>
                                </div>
                            </div> tickets for {{ $ticket->name }}.
                        </div>
                    </div>
                    <div id="ticket-map" class="col-xs-12 col-md-6">
                        {!! $ticket->getStaticMap() !!}
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <hr />
            </div>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="ticket-title">Step 2.</h2>
                        <h2 class="ticket-subtitle"><small>Tell us who's coming.</small></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <form id="buy-ticket-form" method="POST" action="{{ route('storefront.tickets.ticket.buy', $ticket->slug) }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Full Name</label>
                                <input class="form-control" type="text" name="full_name" placeholder="E.G Ozzy Osbourne" />
                                <small class="form-text text-muted">This is the name that will be associated with the ticket(s).</small>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" name="email" placeholder="E.G ozzy@blacksabbath.com" />
                                <small class="form-text text-muted">This is the email your tickets will be sent to.</small>
                            </div>
                            <div class="form-group">
                                <label>Confirm Email</label>
                                <input class="form-control" type="text" name="email_confirmation" placeholder="E.G ozzy@blacksabbath.com" />
                                <small class="form-text text-muted">Please confirm the email address the tickets will be sent to.</small>
                            </div>
                            <input id="total_tickets" name="total_tickets" type="hidden" value="1" />
                            <input id="price_per_ticket" name="price_per_ticket" type="hidden" />
                        </form>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="alert alert-info">
                            <h4>Attention!</h4>
                            <p>
                                We only need to know the details of the main ticket holder, this is name of the person who may
                                present the tickets at the event. If your event checks against ID you may have to present some
                                form of identification to enter the venue, I.E The primary ticket holder's details should be
                                the same as what is shown on the ID.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <hr />
            </div>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="ticket-title">Step 3.</h2>
                        <h2 class="ticket-subtitle"><small>Review and confirm.</small></h2>
                    </div>
                    <div class="col-xs-12">
                        <table id="buy-ticket-table" class="table table-responsive table-striped">
                            <thead>
                            <tr>
                                <th>Event/Gig</th>
                                <th>Number of Tickets</th>
                                <th>Price per Ticket</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    {{ $ticket->name }}
                                </td>
                                <td id="number-of-tickets">
                                    1
                                </td>
                                @if($ticket->price === null)
                                    <td>&pound;
                                        <input
                                            type="number"
                                            placeholder="Name your price"
                                            min="1"
                                            step=".01"
                                            oninput="this.value = Math.abs(this.value)"
                                            onchange="setTicketPrice(event)"
                                        />
                                    </td>
                                @elseif($ticket->price === 0)
                                    <td>&pound;FREE</td>
                                @else
                                    <td>&pound;{{ number_format($ticket->price/100,2) }}</td>
                                @endif
                            </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-primary" onclick="$('#buy-ticket-form').submit()">I confirm these details are correct.</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        let $total_input = $('#total_tickets');

        function addAttendee(){
            let $total = $('#buy-ticket-counter-total');
            let total = parseInt($total.text());
            $total.text(total+1);
            $total_input.val(total+1);
            $('#number-of-tickets').text(total+1);
        }

        function removeAttendee(){
            let $total = $('#buy-ticket-counter-total');
            let total = parseInt($total.text());
            if(total > 1){
                $total.text(total-1);
                $total_input.val(total-1);
                $('#number-of-tickets').text(total-1);
            }
        }

        let numberBeingSet = false;
        function customAttendeeNumber(){
            if(!numberBeingSet){
                let $total = $('#buy-ticket-counter-total');
                let total = parseInt($total.text());

                $total.html('<input type="number" value="'+total+'" onblur="setCustomAttendeeNumber(event)" min="1" step="1" oninput="this.value = Math.abs(this.value)" />');

                let $totalInput = $('#buy-ticket-counter-total input');
                $totalInput.focus();

                $total_input.val(total);
                $('#number-of-tickets').text(total);

                numberBeingSet = true;
            }
        }

        function setCustomAttendeeNumber(){
            let $total = $('#buy-ticket-counter-total');

            let $totalInput = $('#buy-ticket-counter-total input');
            if($totalInput.val() !== null){
                let total = parseInt($totalInput.val());

                $total.text(total);
                $total_input.val(total);
                $('#number-of-tickets').text(total);
                numberBeingSet = false;
            }
        }

        function setTicketPrice(e){
            let price = e.target.value;
            $('#price_per_ticket').val(price);
        }
    </script>
@endsection