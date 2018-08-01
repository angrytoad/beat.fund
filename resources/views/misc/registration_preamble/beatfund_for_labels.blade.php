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
            <div class="col-xs-12 col-md-6">
                <div class="list-group">
                    <div class="list-group-item">
                        <h3 class="list-group-item-heading">
                            Beat Fund for Labels
                            <a href="{{ route('register-label') }}" class="pull-right">
                                <button class="btn btn-primary btn-sm">Create a label account</button>
                            </a>
                        </h3>
                        <p class="text-muted list-group-item-text">
                            Manage multiple artists all under one roof.
                        </p>
                    </div>
                </div>
                <div class="list-group">
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Manage multiple artists</p>
                        <p class="list-group-item-text">
                            Manage multiple artists through your organisation.
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Keep {{ 100 - env("BEATFUND_LABEL_SALES_SHARE") }}% of revenue</p>
                        <p class="list-group-item-text">
                            Labels get {{ env("BEATFUND_LABEL_SALES_SHARE") - env("BEATFUND_SALES_SHARE") }}% less for having more complexity.
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Login with multiple accounts</p>
                        <p class="list-group-item-text">
                            Beat Fund allows you to set up multiple accounts and permissions, helping to scale with your business.
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Complex automatic payments</p>
                        <p class="list-group-item-text">
                            Set your split rate and Beat Fund will automatically pay both the label and artist automatically
                            their designated split on any revenue that goes through Beat Fund.
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Slower setup, more control</p>
                        <p class="list-group-item-text">
                            Due to the complexity of managing multiple artists, label accounts can take longer to set up.
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Buy once, apply everywhere.</p>
                        <p class="list-group-item-text">
                            Purchasing optional extras will enable those features for all past, present and future artists in
                            your roster automatically!
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="list-group hidden-sm hidden-xs">
                    <div class="list-group-item">
                        <h3 class="list-group-item-heading">
                            Beat Fund for Artists
                            <a href="{{ route('register') }}" class="pull-right">
                                <button class="btn btn-default btn-sm">Create an artist account</button>
                            </a>
                        </h3>
                        <p class="text-muted list-group-item-text">
                            Free access to industry leading tools all for free.
                        </p>
                    </div>
                </div>
                <div class="list-group hidden-sm hidden-xs">
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Manage a single artist</p>
                        <p class="list-group-item-text">
                            An artist account will only let you manage a single artist.
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Keep {{ 100 - env("BEATFUND_SALES_SHARE") }}% of revenue</p>
                        <p class="list-group-item-text">
                            Individual artists/bands earn the best rate on Beat Fund.
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Login with a single account</p>
                        <p class="list-group-item-text">
                            Use a single login to access and manage your account, no complex permissions to set up.
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Simple automatic payments</p>
                        <p class="list-group-item-text">
                            Simple to set up and leave running, designate one account for payments to be made into and
                            let Beat Fund automatically pay you directly.
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Fast setup, less control</p>
                        <p class="list-group-item-text">
                            Artist accounts are lightning fast to set up and get your selling! You can be up and running
                            in 5 minutes.
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Free goodies</p>
                        <p class="list-group-item-text">
                            Occasionally, we may make certain premium label features available for free for individual artists to try.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="list-group">
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Priority email support</p>
                        <p class="list-group-item-text">
                            Are you selling more than £5,000 annually through Beat Fund? Get priority email support direct
                            from us 365 days a year.
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Free Phone support</p>
                        <p class="list-group-item-text">
                            If you're selling more than £35,000 per annum on Beat Fund you'll get free phone support in all
                            standard business hours.
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="list-group-item-heading bold text-info">Custom support plans</p>
                        <p class="list-group-item-text">
                            If you feel you need a dedicated account manager, why not get in touch and see how we can help
                            | <strong>tom@beat.fund</strong>
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