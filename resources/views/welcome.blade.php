@extends('layouts.app')

@section('title','The Revolution will be Digitized')

@section('content')
<div id="welcome">
    <div id="welcome-banner">
        <div id="welcome-container">
            <div id="welcome-container-child">
                <div id="welcome-container-child-container">
                    <h1 id="title">Beat Fund</h1>
                    <h3 id="subtitle">Supporting independent artists for FREE, FOREVER</h3>
                    <div id="store-sampler">
                        @foreach(\App\Helpers\Helper::storeHelpers()->getStoreProductsSampler() as $product)
                            <a href="{{ route('artist.store.product', [$product->store_slug, $product->id]) }}" data-tooltip title="{{ $product->name }}">
                                <div class="product">
                                    <img src="{{ $product->downsizedImage() }}" />
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-xs-12">
                <h2>Sell Music, Tickets & more, all for free.</h2>
                <p class="lead">
                    Beat Fund gives you the tools to manage and <strong>sell your music online</strong>, for free, forever. The one guiding principle
                    for Beat Fund has always been to offer the service for free at the point of use, this means its free to set up a store,
                    free to sell gig tickets, synchronise your music, distribute your music to... This list could get long, maybe you should
                    just read the <a href="#roadmap"><strong>roadmap</strong></a> instead.
                </p>
                <p class="lead">
                    Beat Fund also allows you to <strong>sell tickets to events and gig you are playing at</strong>, easily create digital tickets with complete
                    control of pricing, all free with your Beat Fund account.
                </p>
            </div>
            <div class="col-md-3 col-sm-4 col-sm-offset-4 col-md-offset-0 col-xs-6 col-xs-offset-3">
                <img src="/images/beatfund/beat_fund_square.jpg" width="100%" />
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <iframe src="https://open.spotify.com/embed/user/duenna/playlist/0yXzk5Fv0tAt7qy2N7bFFy" width="100%" height="400px" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
            </div>
            <div class="col-xs-12 col-md-6">
                <h2>Yes... some of us are on Spotify too!</h2>
                <p class="lead">
                    As part of ongoing efforts to promote some of the best independent music around, Beat Fund runs its own
                    playlist on Spotify with 100% Beat Fund artists and bands. Come check out some of the awesome music
                    and get updates as an when new artists are added to the site!
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 col-xs-12">
                <h2>A Fairer Deal for all.</h2>
                <p class="lead">
                    Not only do I believe in supporting independent Artists and Bands, but I also believe in fair pricing. With
                    a simple and flat 10% revenue share policy across all tools and services, you can keep more of what you earn
                    whilst still using a huge suite of great tools.
                </p>
                <p class="lead">
                    For more information and examples, please see our <a href="{{ route('revenue_sharing_policy') }}">Revenue Sharing Policy.</a>
                </p>
            </div>
            <div class="col-md-3 col-sm-4 col-sm-offset-4 col-md-offset-0 col-xs-6 col-xs-offset-3">
                <i class="fas fa-coins"></i>
            </div>
        </div>
        <div class="row" id="roadmap">
            <div class="col-xs-12">
                <h2>Roadmap</h2>
                <p class="lead">
                    I feel that its not only important to know where you've gone, but also where you are going, Beat Fund is going to take
                    a monumental amount of work to make it the worlds best platform for independent artists, but with your support we
                    can damn well get it there!
                </p>
                <p class="lead">
                    Below you'll find a list of features that have arrived or are coming to Beat Fund at some point in the future. This is
                    by no means a complete list but this should hopefully give you an indication of the scale of the project.
                </p>
            </div>
            <div class="col-xs-12" id="roadmap-wrap">
                <div class="roadmap-item jumbotron">
                    <p><strong><i class="far fa-newspaper"></i> Artist Profiles</strong></p>
                    <div>
                        Allow artists and bands to create a profile to tell the world a little bit about themselves.
                    </div>
                    <p class="text-success text-left"><small>STATUS: <strong>Completed</strong></small></p>
                </div>
                <div class="roadmap-item jumbotron">
                    <p><strong><i class="fas fa-shopping-cart"></i> Online Store</strong></p>
                    <div>
                        Artists and bands can set up and sell their music online, completely free of charge.
                    </div>
                    <p class="text-success text-left"><small>STATUS: <strong>Completed</strong></small></p>
                </div>
                <div class="roadmap-item jumbotron">
                    <p><strong><i class="fas fa-ticket-alt"></i> Digital Gig Tickets</strong></p>
                    <div>
                        Artists and bands can create and sell gig tickets online for their events, completely free of charge!
                    </div>
                    <p class="text-warning text-left"><small>STATUS: <strong>Releasing Soon</strong></small></p>
                </div>
                <div class="roadmap-item jumbotron">
                    <p><strong><i class="fas fa-film"></i> Synchronisation Rights</strong></p>
                    <div>
                        Artists and bands will be able to sell synchronisation rights to their music for use in TV, Films, Ads and more.
                    </div>
                    <p class="text-info text-left"><small>STATUS: <strong>In Development</strong></small></p>
                </div>
                <div class="roadmap-item jumbotron">
                    <p><strong><i class="fas fa-battery-quarter"></i> Small Streaming Platforms</strong></p>
                    <div>
                        Artists and bands will be able to choose from a small selection of smaller streaming platforms to distribute their music across to.
                    </div>
                    <p class="text-info text-left"><small>STATUS: <strong>In Development</strong></small></p>
                </div>
                <div class="roadmap-item jumbotron">
                    <p><strong><i class="fab fa-bitcoin"></i> Alternative payment methods</strong></p>
                    <div>
                        Artists and bands will be able to choose if they want to allow customers to use alternative payment methods when
                        purchasing music.
                    </div>
                    <p class="text-info text-left"><small>STATUS: <strong>In Development</strong></small></p>
                </div>
                <div class="roadmap-item jumbotron">
                    <p><strong><i class="fas fa-tshirt"></i> Merchandise</strong></p>
                    <div>
                        In the near future, you'll be able to sell your own Merchandise directly through Beat Fund.
                    </div>
                    <p class="text-info text-left"><small>STATUS: <strong>In Development</strong></small></p>
                </div>
                <div class="roadmap-item jumbotron">
                    <p><strong><i class="fas fa-battery-full"></i> Large Streaming Platforms</strong></p>
                    <div>
                        In the hopefully not to distant future, Artists and Bands will be able to optionally distribute their music
                        to large music streaming platforms, completely free of charge!
                    </div>
                    <p class="text-info text-left"><small>STATUS: <strong>In Development</strong></small></p>
                </div>
                <div class="roadmap-item jumbotron">
                    <p><strong><i class="fas fa-share-alt"></i> Share Beat Fund</strong></p>
                    <div>
                        Getting the word out there is the best way to support the site.
                    </div>
                    <br />
                    <div class="sharethis-inline-share-buttons"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h2 class="text-center">Join the {{ \App\Helpers\Helper::storeHelpers()->getStoresCount() }} artists and bands already using Beat Fund</h2>
                <div id="artist-store-sampler">
                    @foreach(\App\Helpers\Helper::getArtistStoresSampler() as $store)
                        <a href="{{ route('artist.store', $store->slug) }}">
                            <div class="artist">
                                <p class="artist-name">{{ $store->user->profile->artist_name }}</p>
                                <img src="{{ $store->downsizedAvatar() }}" />
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h2>Built for the community, driven by the community.</h2>
                <p class="lead">
                    Beat Fund was never meant to be just another corporate platform, unlike many other larger music distribution tools, I'm trying to create
                    a real music community of great and talented musicians. There is a whole heap of community-orientated features planned, why not take a look
                    at some of what's coming soon, below...
                </p>
            </div>
            <div class="col-xs-12">
                <div class="community-features">
                    <div class="jumbotron">
                        <p><i class="fas fa-bullhorn"></i> <strong>Weekly Guest Blog</strong></p>
                        <p>
                            Each week a Beat Fund Artist/Band will be invited to write about what they care about the most, whether its
                            supporting independent music, talking about what they've been working on, or just their favourite types of cheese.
                        </p>
                        <p class="text-info text-left"><small>STATUS: <strong>In Development</strong></small></p>
                    </div>
                    <div class="jumbotron">
                        <p><i class="fas fa-microphone"></i> <strong>Global Recording Network</strong></p>
                        <p>
                            Provide the tools for Artists and Bands to find and collaborate with local recording houses and studios.
                        </p>
                        <p>
                            Artists and Bands will be able to rate and provide recommendations to other Beat Fund bands.
                        </p>
                        <p class="text-info text-left"><small>STATUS: <strong>In Development</strong></small></p>
                    </div>
                    <div class="jumbotron">
                        <p><i class="fas fa-building"></i> <strong>Gig notices</strong></p>
                        <p>
                            Nothing is better and more exciting than performing live, what's bad is that sometimes its hard
                            to find gigs and venues in your area, Gig Notices will let you team up with other Independent artists
                            and Bands to organise and play gigs.
                        </p>
                        <p class="text-info text-left"><small>STATUS: <strong>In Development</strong></small></p>
                    </div>
                    <div class="jumbotron">
                        <p><i class="fas fa-broadcast-tower"></i> <strong>Beat Fund Radio</strong></p>
                        <p>
                            We can't get you beamed down into your local radio station, but Beat Fund radio will give you the air
                            time you deserve, I'm working on setting up a live internet radio station to showcase the best
                            music Beat Fund has to offer. Bear with me on this one, its complicated!
                        </p>
                        <p class="text-info text-left"><small>STATUS: <strong>In Development</strong></small></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 col-xs-12">
                <h2>About Me</h2>
                <p class="lead">
                    I'm a Web Developer from Nottinghamshire in the UK, if you don't know where that is then its easier to remember it as
                    where <a href="https://en.wikipedia.org/wiki/Robin_Hood" target="_blank">Robin Hood</a> is from. I work full time as
                    a developer and I build Beat Fund in my spare time.
                </p>
                <p class="lead">
                    If it sometimes feels like Updates are slow then bear in mind I have to build this in my own time, the more support
                    that people give to Beat Fund, the more time I can afford to spend working on it. I don't currently accept donations
                    as I don't believe its the right thing to do, you can support the Site by purchasing music through it or helping to spread
                    the message about giving a fair deal back to artists.
                </p>
                <p class="lead">
                    If you'd like to contact me, you can send an email to <strong>tom@beat.fund</strong>
                </p>
            </div>
            <div class="col-md-3 col-sm-4 col-sm-offset-4 col-md-offset-0 col-xs-6 col-xs-offset-3">
                <img src="/images/misc/portrait_profile_SMALL.jpg" width="100%" />
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script>
    </script>
@endsection