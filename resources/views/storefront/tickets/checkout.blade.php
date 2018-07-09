@extends('layouts.app')

@section('title', 'Checkout your tickets')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Your Tickets
                </div>
                <div class="panel-body">
                    @if(count($cart['tickets']) > 0)
                        <table id="ticket-cart-table" class="table table-responsive table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Creted By</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart['tickets'] as $cart_item)
                                <tr>
                                    <td class="ticket-information-icon" data-tooltip title="This ticket is in the name of {{ $cart_item['purchaser']['full_name'] }} and will be sent to {{ $cart_item['purchaser']['email'] }}.">
                                        <i class="fas fa-info-circle"></i>
                                    </td>
                                    <td>
                                        <a href="{{ route('storefront.tickets.ticket', $cart_item['ticket']->slug) }}">
                                            {{ $cart_item['ticket']->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($cart_item['ticket']->ticket_store->user->store->live)
                                            <a href="{{ route('artist.store', $cart_item['ticket']->ticket_store->user->store->slug) }}">
                                                {{ $cart_item['ticket']->ticket_store->user->profile->artist_name }}
                                            </a>
                                        @else
                                            {{ $cart_item['ticket']->ticket_store->user->profile->artist_name }}
                                        @endif
                                    </td>
                                    <td>&pound;{{ number_format($cart_item['price']/100,2) }}</td>
                                    <td>{{ number_format($cart_item['quantity']) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <table id="cart-total" class="table">
                            <tbody>
                            <tr>
                                <td>Subtotal:</td>
                                <td><strong>&pound;{{ number_format($cart['total']/100,2) }}</strong></td>
                            </tr>
                            @if($cart['total'] === 0)
                                <tr>
                                    <td>Total:</td>
                                    <td id="cart-total-total"><strong>&pound;{{ number_format(($cart['total'])/100,2) }}</strong></td>
                                </tr>
                            @else
                                <tr>
                                    <td>Stripe Fees:</td>
                                    <td><strong>+ &pound;{{ number_format(env('STRIPE_FEE')/100,2) }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Total:</td>
                                    <td id="cart-total-total"><strong>&pound;{{ number_format(($cart['total']+env('STRIPE_FEE'))/100,2) }}</strong></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Checkout with your Tickets</div>
                <div class="panel-body">
                    <div class="alert alert-success">
                        This checkout is secured by <strong>128-Bit SSL Encryption</strong>.
                    </div>
                    @if(Auth::user())
                        @if(Auth::user()->stripe_customer_account)
                            <p>
                                Please select the card you'd like to use from the dropdown below.
                            </p>
                            <form method="POST" action="{{ route('storefront.tickets.checkout') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <select class="form-control" name="card">
                                        @foreach(Auth::user()->stripe_customer_account->cards as $card)
                                            @if($card->isDefaultCard())
                                                <option value="{{ $card->id }}" selected>(Default) {{ $card->name }} | {{ $card->brand }} | {{ $card->last4 }} | {{ $card->exp_month }}/{{ $card->exp_year }}</option>
                                            @else
                                                <option value="{{ $card->id }}">{{ $card->name }} | {{ $card->brand }} | {{ $card->last4 }} | {{ $card->exp_month }}/{{ $card->exp_year }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary"><i class="fas fa-lock"></i> Complete Order</button>
                                </div>
                                <img class="pull-right" src="/images/checkout/powered_by_stripe.png" />
                            </form>
                            <hr />
                            <form action="{{ route('storefront.tickets.checkout') }}" method="POST" id="payment-form">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-row">
                                        <label for="card-element">
                                            Credit or debit card
                                        </label>
                                        <div id="card-element">
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>

                                        <!-- Used to display Element errors. -->
                                        <div id="card-errors" role="alert"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <img class="pull-left" src="/images/checkout/powered_by_stripe.png" />
                                    <button class="btn btn-success"><i class="fas fa-lock"></i> Buy Tickets</button>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('storefront.tickets.checkout') }}" method="POST" id="payment-form">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-row">
                                        <label for="card-element">
                                            Credit or debit card
                                        </label>
                                        <div id="card-element">
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>

                                        <!-- Used to display Element errors. -->
                                        <div id="card-errors" role="alert"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <img class="pull-left" src="/images/checkout/powered_by_stripe.png" />
                                    <button class="btn btn-success"><i class="fas fa-lock"></i> Buy Tickets</button>
                                </div>
                            </form>
                        @endif
                    @else
                        <form action="{{ route('storefront.tickets.checkout') }}" method="POST" id="payment-form">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-row">
                                    <label for="card-element">
                                        Credit or debit card
                                    </label>
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>

                                    <!-- Used to display Element errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <img class="pull-left" src="/images/checkout/powered_by_stripe.png" />
                                <button class="btn btn-success"><i class="fas fa-lock"></i> Buy Tickets</button>
                            </div>

                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        var style = {
            base: {
                // Add your base input styles here. For example:
                fontSize: '18px',
                color: "#007BFF",
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Create a token or display an error when the form is submitted.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the customer that there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
@endsection