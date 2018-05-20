@extends('layouts.app')

@section('title', 'Cart')
@section('meta_description', 'Edit and Review your Shopping Cart.')

@section('content')
<div id="cart" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('storefront.cart') }}
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Cart</div>
                <div class="panel-body">
                    @if(count($cart['products']) > 0)
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
                        <a href="{{ route('storefront.checkout') }}">
                            <button class="btn btn-primary pull-right">Proceed to Checkout</button>
                        </a>
                    @else
                        <h4>Oops!</h4>
                        <p>
                            It looks like you don't have anything in your cart at the moment, but not to worry. We have
                            tons of great music by the worlds best independent artists we're sure there will be something
                            you'll love. Why not <a href="{{ route('storefront') }}">Check out the store?</a>
                        </p>
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