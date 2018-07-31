@extends('layouts.app')

@section('title', 'Beatfund for Labels')

@section('content')
    <div id="beatfund-for-labels" class="container">
        @include('layouts.flash_message')
        <div class="row">
            <div class="col-xs-12">
                <div class="preamble-image">
                    <img src="/images/misc/registration_preamble/label_1.jpg" />
                </div>
            </div>
        </div>

        <div id="beatfund-for-labels-title" class="row">
            <div class="col-xs-12">
                <h3>Music, Gigs, Merchandise & Distribution... all in one place.</h3>
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-8">
                <p class="lead">
                    Beat Fund for labels is at its core, a <strong>free</strong> service to help you organise, manage and sell yours
                    clients music across the globe.
                </p>
                <p class="lead">
                    With industry leading organisational tools to help you manage your own label as much as your artists, Beat Fund
                    for labels scales perfectly with your business.
                </p>
                <p class="lead">
                    <a href="{{ route('register-label') }}">
                        <button class="btn btn-success btn-lg">Like where this is going?</button>
                    </a>
                </p>
            </div>
            <div class="col-md-4">
                <div class="jumbotron">
                    <p>
                        Beat Fund is <strong>Free</strong> to use, and you keep {{ 100 - env("BEATFUND_LABEL_SALES_SHARE") }}% of any revenue you
                        generate through Beat Fund.
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Beatfund for Labels</div>
                    <div class="panel-body">

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