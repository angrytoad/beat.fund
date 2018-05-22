@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div id="checkout" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('storefront.checkout') }}
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="{{ route('storefront.checkout.user') }}">
                        <div class="checkout-option user">
                            <div class="checkout-title">Checkout with My Account</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="{{ route('storefront.checkout.guest') }}">
                        <div class="checkout-option guest">
                            <div class="checkout-title">Checkout as Guest</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        fbq('track', 'InitiateCheckout');
    </script>

@endsection