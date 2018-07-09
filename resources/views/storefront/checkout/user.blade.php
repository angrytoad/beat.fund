@extends('layouts.app')

@section('title', 'User Checkout')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('storefront.checkout.user') }}
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                This checkout is secured by <strong>128-Bit SSL Encryption</strong>.
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Your Basket</div>
                <div class="panel-body">
                    <p>

                    </p>
                    <table id="cart-table" class="table table-responsive table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Artist</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart['products'] as $cart_item)
                            <tr>
                                <td>
                                    <a href="{{ route('artist.store.product', [$cart_item['product']->store->slug, $cart_item['product']->id]) }}">
                                        {{ $cart_item['product']->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('artist.store', $cart_item['product']->store->slug) }}">
                                        {{ $cart_item['product']->store->user->profile->artist_name }}
                                    </a>
                                </td>
                                <td>&pound;{{ number_format($cart_item['price']/100,2) }}</td>
                                <td>
                                    <form method="POST" action="{{ route('artist.store.product.remove_from_cart',[$cart_item['product']->store->slug,$cart_item['product']->id]) }}">
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
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Your Cards</div>
                <div class="panel-body">
                    @if($cart['total'] === 0)
                        <p>
                            This order has no cost, you may complete your order right away.
                        </p>
                        <form method="POST" action="{{ route('storefront.checkout') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <button class="btn btn-primary"><i class="fas fa-lock"></i> Complete Order</button>
                            </div>
                            <img class="pull-right" src="/images/checkout/powered_by_stripe.png" />
                        </form>
                    @else
                        @if(Auth::user()->stripe_customer_account)
                            <p>
                                Please select the card you'd like to use from the dropdown below.
                            </p>
                            <form method="POST" action="{{ route('storefront.checkout') }}">
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
                            <p>
                                Want to use a different card? No problem, just head over to your account settings
                                and <a href="{{ route('account.cards') }}">add a new card.</a>
                            </p>
                        @else
                            <h4>Adding a card</h4>
                            <p>
                                It looks like you don't have any cards added to your account yet, in order to checkout we
                                require you to add a card to your account, <a href="{{ route('account.cards') }}">you can do that here.</a>
                            </p>
                        @endif
                    @endif
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