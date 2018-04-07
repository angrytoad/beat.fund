@extends('layouts.app')

@section('title', 'Connected Accounts')

@section('content')
<div id="cards" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('account.stripe') }}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Stripe</div>
                <div class="panel-body">
                    <p>
                        In order for you to take payments on the platform, we require you to link a Stripe account. Stripe is a payment platform that
                        offers affordable and reliable payments directly to your bank account.
                    </p>
                    <hr />
                    @if(!empty($stripe_account))
                        <div class="jumbotron">
                            <h4 class="text-muted">Connected Account:</h4>
                            <strong>Email:</strong> {{ $stripe_account['email'] }} <br />
                            <strong>Country:</strong> {{ $stripe_account['country'] }} <br />
                            <strong>Name on statement:</strong> {{ $stripe_account['statement_descriptor'] }}
                        </div>
                        <a href="{{ \App\Helpers\Helper::getStripeConnectUrl()  }}">
                            <button class="btn btn-primary">Authorize a new account</button>
                        </a>
                    @else
                        <a href="{{ \App\Helpers\Helper::getStripeConnectUrl()  }}">
                            <img src="/images/stripe_connect.png" />
                        </a>
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