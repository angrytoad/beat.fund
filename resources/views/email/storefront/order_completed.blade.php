@extends('email.layout.base')

@section('title', 'Thanks for your Order')

@section('styling')
    <style>
        #order-total-table-wrapper{
            text-align: right;
        }

        #order-total-table-wrapper table{
            width:auto;
            display:inline-block;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <h2 class="title">Thanks for supporting independent artists!</h2>
        <div>
            @if($cart['total'] === 0)
                <p>
                    Thanks for your recent order from Beat Fund. Your FREE order is ready for download from your account.
                </p>
            @else
                <p>
                    Thanks for your recent order from Beat Fund. Your card has been charged a total of <strong>&pound;{{ number_format(($cart['total'] + (int) env('STRIPE_FEE'))/100,2) }}</strong>.
                </p>
            @endif

            <p>
                A summary of your purchase is shown below.
            </p>
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Artist</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart['products'] as $cart_item)
                        <tr>
                            <td><a href="{{ route('artist.store.product',[$cart_item['product']->store->slug, $cart_item['product']->id]) }}">{{ $cart_item['product']->name }}</a></td>
                            <td><a href="{{ route('artist.store', $cart_item['product']->store->slug) }}">{{ $cart_item['product']->store->user->profile->artist_name }}</a></td>
                            <td>&pound; {{ number_format($cart_item['price']/100,2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="order-total-table-wrapper">
                <table>
                    <tbody>
                    <tr>
                        <td>Subtotal:</td>
                        <td><strong>&pound;{{ number_format($cart['total']/100,2) }}</strong></td>
                    </tr>
                    @if($cart['total'] === 0)
                        <tr>
                            <td>Total:</td>
                            <td><strong>&pound;{{ number_format($cart['total']/100,2) }}</strong></td>
                        </tr>
                    @else
                        <tr>
                            <td>Stripe Fees:</td>
                            <td class="blue"><strong>+&pound;{{ number_format(env('STRIPE_FEE')/100,2) }}</strong></td>
                        </tr>
                        <tr>
                            <td>Total:</td>
                            <td><strong>&pound;{{ number_format(($cart['total'] + (int) env('STRIPE_FEE'))/100,2) }}</strong></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <p>
                <a href="{{ route('purchases') }}">
                    <button>View Order</button>
                </a>
            </p>
            <p class="small">
                Having trouble clicking the link? Please use the following url: <br />{{ route('purchases') }}
            </p>
        </div>
    </div>
@endsection
