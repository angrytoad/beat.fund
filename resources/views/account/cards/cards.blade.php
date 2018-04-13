@extends('layouts.app')

@section('title', 'Cards')

@section('content')
<div id="cards" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('account.cards') }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Cards</div>
                <div class="panel-body">
                    @if($stripeCustomerAccount)
                        <div id="cards-display" class="row">
                            @foreach($stripeCustomerAccount->cards as $card)
                                <div class="col-md-4 col-sm-6">
                                    <div class="card-display">
                                        <p class="card-display-name">{{ $card->name }} </p>
                                        <p class="text-muted"><small>{{ $card->exp_month }}/{{ $card->exp_year }}</small></p>
                                        <hr />
                                        <p class="text-muted">
                                            <small>
                                                **** **** **** {{ $card->last4 }} ({{ $card->brand }})  <br />


                                            </small>

                                        </p>
                                        @if($stripeCustomerAccount->default_card_id === $card->card_token)
                                            <div class="default-card" title="This is your default card">
                                                <i class="fas fa-star text-primary"></i>
                                            </div>
                                        @endif
                                        <div class="card-actions">
                                            <a href="{{ route('account.cards.card',$card->id) }}">
                                                <i class="fas fa-eye" title="View Card"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                <div class="col-md-4 col-sm-6">
                                    <div class="card-display">
                                        <p class="card-display-name">Add a new card </p>
                                        <p class="text-muted"><small>Set up another card for you account</small></p>
                                        <hr />
                                        <a onclick="$('#addCardModal').modal()">
                                            Add a Card
                                        </a>
                                    </div>
                                </div>
                        </div>

                    @else
                        <h4>Hey {{ Auth::user()->first_name }}, looks like you don't have any saved cards yet.</h4>
                        <p>
                            Adding a saved card to your account will allow you to checkout even easier in the future. Add
                            multiple cards and even set a default to use with all future purchases and we'll do the rest.
                        </p>
                        <p>
                            If you'd prefer not to add a card, that's no problem as well. You can continue to enter your
                            card details at checkout without any problems.
                        </p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCardModal">
                            Add a Card
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addCardModal" tabindex="-1" role="dialog" aria-labelledby="addCardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addCardModalLabel">Add a Card</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('account.cards.add') }}" method="POST" id="payment-form">
                {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group">
                    <label>Card Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Give your card a memorable name" />
                </div>
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
                <hr />
                <div class="form-check">
                    <input class="form-check-input" name="make_default" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Make this card your default?
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary">Add Card</button>
            </div>
            </form>
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