@extends('layouts.app')

@section('title', 'Cart')
@section('meta_description', 'Edit and Review your Shopping Cart.')

@section('content')
    <div id="ticket-cart" class="container">
        @include('layouts.flash_message')
        {{ Breadcrumbs::render('storefront.tickets.cart') }}
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Cart</div>
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
                                    <th>Actions</th>
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
                                        <td>
                                            <form method="POST" action="{{ route('storefront.tickets.ticket.remove_from_cart', $cart_item['ticket']->slug ) }}">
                                                {{ csrf_field() }}
                                                <button class="btn btn-sm btn-default"><i class="fas fa-times"></i></button>
                                            </form>

                                        </td>
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
                            <a href="{{ route('storefront.tickets.checkout') }}">
                                <button class="btn btn-primary pull-right checkout-button">Proceed to Checkout</button>
                            </a>
                            <a href="{{ route('storefront.tickets') }}">
                                <button class="btn btn-default pull-right continue-shopping">Continue shopping</button>
                            </a>
                        @else
                            <h4>Oops!</h4>
                            <p>
                                It looks like you don't have anything in your ticket cart at the moment, but not to worry. There's all sorts
                                of amazing events happening across the glove, i'm sure we can find something to pique your interest!
                            </p>
                            <p>
                                Why not check out our tickets page to see what's happening near you?
                            </p>
                            <a href="{{ route('storefront.tickets') }}"><button class="btn btn-primary">Take me to the tickets page!</button></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        A small thank you
                    </div>
                    <div class="panel-body">
                        <p>
                            This is just a little message to say thanks for supporting independent music.
                        </p>
                        <p>
                            Every ticket purchase helps the Artists and Bands you support keep creating all the
                            awesome music you love!
                        </p>
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