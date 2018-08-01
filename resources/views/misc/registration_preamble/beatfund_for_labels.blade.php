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
                    Beat Fund for labels is at its core, a <strong>free</strong> service to help you organise, manage and sell your
                    clients music across the globe.
                </p>
                <p class="lead">
                    With industry leading organisational tools to help you manage your own label as much as your artists, Beat Fund
                    for labels scales perfectly with your business and is available completely free of cost.
                </p>
                <p class="lead">
                    <a href="{{ route('register-label') }}">
                        <button class="btn btn-primary btn-lg">Like where this is going?</button>
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
                    <div class="panel-body">
                        <h3 class="beatfund-for-labels-preamble-title">A simple interface to help you grow your label.</h3>
                        <hr />
                        <p class="lead">
                            Beat Fund has been designed specifically as a platform to help facilitate the sale and distribution of music.
                            Great care has been taken to provide not only a simple but intuitive interface to manage multiple accounts from,
                            helping to avoid many of the pitfalls that <strong>other paid services</strong> have.
                        </p>
                        <p class="lead">
                            Originally designed for individual artist, Beat Fund has been built to provide a great experience when drilling
                            down into an individual account. Analytics, multi-file uploads and flexible pricing all as standard for Beat Fund accounts.
                            Why not take a look at some of the great features that are <strong>available for free</strong> when using Beat Fund.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="beatfund-for-labels-preamble-title">Do I need a label account?</h3>
                        <hr />
                        <p class="lead">
                            There are many reasons why you may not need a Label account to manage your music on Beat Fund, take a look at
                            a comparison of features to find out if having a label account is right for you.
                        </p>
                        <p class="lead">
                            In general if you plan on managing your own account then we'd recommend setting up an artist account. It's
                            simpler, quicker to setup and you keep more of your revenue. If you're looking to manage multiple artists and
                            need greater flexibility on revenue splits within your organisation we'd recommend using a label account.
                        </p>
                    </div>
                </div>
            </div>
            @include('misc.registration_preamble.account_type_comparison')
        </div>
    </div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection