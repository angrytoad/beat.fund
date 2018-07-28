@extends('layouts.app')

@section('title', 'Beatfund for Artists')

@section('content')
<div id="beatfund-for-artists" class="container">
    @include('layouts.flash_message')
    <div class="row">
        <div id="preamble-sticky" class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>Fulfill your destiny, young skywalker...</h4>
                    <a href="{{ route('register') }}">
                        <button class="btn btn-success btn-lg">Create an account.</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="text-center">Use all our tools for free, and keep a whopping 90% of revenue.</h3>
                    <hr />
                    <p>
                        We don't believe creative tools should sit behind a paywall, we're making it easier than ever for artists and bands
                        to sell their music online, gig tickets, merchandise and more. You'll never need to pay to access Beat Fund tools; that we CAN
                        guarantee!
                    </p>
                    <p>
                        Set up a Artist/Band profile, link to your social media channels and get uploading! The Beat Fund interface has been designed to be
                        as easy to use and simple as possible, easily toggle the availability of your products on the store. Looking to release your EP on a
                        specific date? Pre-load it all onto the site beforehand and simple toggle it live in seconds on the day of release.
                    </p>
                    <hr />
                    <div class="preamble-image">
                        <img src="/images/misc/registration_preamble/artist_1.png" />
                    </div>
                    <small class="text-muted">Setting up a profile on Beat Fund.</small>
                    <hr />
                    <h4>Upload and Sell your music in minutes!</h4>
                    <p>
                        Selling your music on Beat Fund is easy, we provide a simple and intuitive interface for loading your songs onto the service and
                        enabling products for sale. At its heart all we require is an account to pay into when you make a sale, an avatar, a banner and some music!
                    </p>
                    <p>
                        Easily see your live and pending products, Beat Fund allows you to retroactively change your product information, as well as letting you swap
                        add/remove songs from your store products, no more hassle re-creating them again from scratch everytime you want to make a change!
                    </p>
                    <p>
                        Our built-in analytics lets you know exactly how much you sell through the service, including what the customer paid, and your earnings from that sale.
                    </p>
                    <p>
                        <strong>NOTE: All payments should appear in your bank within about 7-10 days from the date of purchased product.</strong>
                    </p>
                    <hr />
                    <div class="preamble-image">
                        <img src="/images/misc/registration_preamble/artist_2.png" />
                    </div>
                    <small class="text-muted">Viewing the tracks of a product.</small>
                    <hr />
                    <h4>More than just a sales platform</h4>
                    <p>
                        Beat Fund doesn't just exist to sell your music, its a whole suite of tools to help showcase who you are and help direct users towards
                        other channels you might want to promote, social links are prominently displayed on your artist/band. With the ability to sell gig tickets
                        you can get your online customers out to see you in person, a powerful tool that any artist/band needs in todays world.
                    </p>
                    <p>
                        Features such as merchandising, distribution to streaming platforms and more enable you to take complete control of your online presence
                        in one easy suite of tools.
                    </p>
                    <hr />
                    <div class="preamble-image">
                        <img src="/images/misc/registration_preamble/artist_3.jpg" />
                    </div>
                    <small class="text-muted">One of the many artist profiles on Beat Fund.</small>
                    <hr />
                    <div class="preamble-image">
                        <img src="/images/misc/registration_preamble/artist_4.jpg" />
                    </div>
                    <small class="text-muted">Simple and effective product pages to let customers listen to your songs.</small>
                    <hr />
                    <h4>A commitment to the music community</h4>
                    <p>
                        We believe its essential to support the independent music community and small enterprise, we're committed to making sure that Beat Fund stays free
                        in the long term, it doesn't matter if you are a small independent singer or a famous rock band, by using Beat Fund you are ensuring that we can
                        continue to support independent music and the creative individuals who help bring it into the world.
                    </p>
                    <a href="{{ route('register') }}">
                        <button class="btn btn-success">Create your account.</button>
                    </a>
                    <hr />
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