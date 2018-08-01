@extends('layouts.app')

@section('title', 'Revenue Sharing Policy')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
            <div class="panel panel-info">
                <div class="panel-heading">Did you know?</div>
                <div class="panel-body">
                    <p>
                        Beat Fund only takes <strong>{{ env('BEATFUND_SALES_SHARE') }}%</strong> of revenue from any of your sales after fees, that's
                        33% less than <a href="https://bandcamp.com/pricing" rel="nofollow" target="_blank">Band Camp</a> and
                        66% less than <a href="https://play.google.com/artists/" rel="nofollow" target="_blank">Google Play.</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="alert alert-warning">
                <p>
                    Psst! If you own a label you'll want to check out more information about label
                    accounts which <a href="{{ route('beatfund_for_labels') }}">can be found here.</a>
                </p>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Beat Fund Artist Revenue Sharing Policy</div>
                <div class="panel-body">
                    <p>
                        Our ethos has always been to provide the best possible deal for artists around the world. Whether
                        that's selling music, merch or anything in between, we believe that in order for the music community
                        to thrive, we must do our best to support it.
                    </p>
                    <div class="jumbotron">
                        <p>
                            Our revenue share policy is aimed to be plain and simple. Beat Fund gives artist accounts <strong>{{ 100 - env('BEATFUND_SALES_SHARE') }}%</strong> of
                            all their music sales for them to do with as they please.
                        </p>
                    </div>
                    <p>
                        See, we told you it was simple!
                    </p>
                    <h4>What are payment fees?</h4>
                    <p>
                        Payment fees are what are charged by 3rd party payment providers for the processing of
                        purchases from your store. This is typically absorbed by both the customer and Beat Fund, so you'll always
                        keep 90% of your sales.
                    </p>
                    <p>
                        When a user goes to purchase some music they are charged a fee by the payment handler (E.G Paypal
                        or Stripe) and this is included in the purchase of the music. The payment provider will take a cut to
                        process the transaction and Beat Fund is then given the remainder of the total purchase cost. This is
                        known as a <strong>Purchase Fee</strong>
                    </p>
                    <hr />
                    <div class="jumbotron">
                        <h2>Example</h2>
                        <p>
                            A user goes to checkout with &pound;10 worth of items in their cart, on checkout they are charged
                            an additional {{ env('STRIPE_FEE') }}p which is paid to Stripe to process the payment, <strong>between 1.4% - 2.9%
                            is also taken</strong> depending on which card was used to pay.
                        </p>
                        <p>
                            Beat Fund covers this charge so the artist will still receive their full 90% (&pound;9), Beat
                            Fund would then take &pound;1 but is charged 1.4% (14p) by Stripe so retains 86p total.
                        </p>
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