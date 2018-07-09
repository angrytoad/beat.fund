@extends('email.layout.base')

@section('title', 'Your tickets to '.$ticketOrder->ticket->name)

@section('styling')
    <style>
        #order-total-table-wrapper{
            text-align: right;
        }

        #order-total-table-wrapper table{
            width:auto;
            display:inline-block;
        }

        #ticket-qr{
            text-align: center;
        }

        #ticket-qr img{
            display:block;
            max-width:100%;
            margin:auto;
        }

        #location-map img{
            width:100%;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div>
            <div id="ticket-qr">
                <img src="data:image/png;base64, {!! $qr_encode !!} ">
                <small>(This is your digital ticket, please print off this email or don't loose it.)</small>
            </div>

            <h2 class="title">Thanks for supporting the artists you love!</h2>
            @if($ticketOrder->total_paid === 0)
                <p>
                    Thanks for your recent order from Beat Fund. Your FREE tickets are ready for you.
                </p>
            @else
                <p>
                    Thanks for your recent order from Beat Fund. Your card has been charged a total of <strong>&pound;{{ number_format(($ticketOrder->total_paid + (int) env('STRIPE_FEE'))/100,2) }}</strong>.
                </p>
            @endif

            <hr />

            <h4>Event Information</h4>
            <table id="event-table">
                <tbody>
                    <tr>
                        <td>Event Name:</td>
                        <td>{{ $ticketOrder->ticket->name }}</td>
                    </tr>
                    <tr>
                        <td>Starts:</td>
                        <td>{{ \Carbon\Carbon::parse($ticketOrder->ticket->start)->toDayDateTimeString() }}</td>
                    </tr>
                    <tr>
                        <td>Ends:</td>
                        <td>{{ \Carbon\Carbon::parse($ticketOrder->ticket->end)->toDayDateTimeString() }}</td>
                    </tr>
                    <tr>
                        <td>Location:</td>
                        <td>
                            {{ $ticketOrder->ticket->location }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div id="location-map">
                {!! $ticketOrder->ticket->getStaticMap() !!}
                <small>Psst... You can click on the map to open it out in google maps.</small>
            </div>

            <hr />

            <div id="order-total-table-wrapper">
                <table>
                    <tbody>
                    <tr>
                        <td>Individual Ticket Price:</td>
                        <td><strong>&pound;{{ number_format($ticketOrder->price/100,2) }}</strong></td>
                    </tr>
                    <tr>
                        <td>Number of Tickets:</td>
                        <td><strong>&pound;{{ $ticketOrder->quantity }}</strong></td>
                    </tr>
                    <tr>
                        <td>Subtotal:</td>
                        <td><strong>&pound;{{ number_format($ticketOrder->total_paid/100,2) }}</strong></td>
                    </tr>
                    @if($ticketOrder->total_paid === 0)
                        <tr>
                            <td>Total:</td>
                            <td><strong>&pound;{{ number_format($ticketOrder->total_paid/100,2) }}</strong></td>
                        </tr>
                    @else
                        <tr>
                            <td>Stripe Fees:</td>
                            <td class="blue"><strong>+&pound;{{ number_format(env('STRIPE_FEE')/100,2) }}</strong></td>
                        </tr>
                        <tr>
                            <td>Total:</td>
                            <td><strong>&pound;{{ number_format(($ticketOrder->total_paid + (int) env('STRIPE_FEE'))/100,2) }}</strong></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
