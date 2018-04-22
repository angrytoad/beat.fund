@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div id="welcome">
    <div id="welcome-banner">
        <div id="welcome-container">
            <div id="welcome-container-child">

                <div class="container">
                    @include('layouts.flash_message')
                </div>
                <h1 id="title">Beat Fund</h1>
                <h3 id="subtitle">Supporting independent artists</h3>
                <p id="subtitle"><a href="{{ route('storefront') }}"><button class="btn btn-primary">View the Store</button></a></p>
            </div>
        </div>
        <div id="welcome-background">
            <div id="welcome-background-items">
                @foreach($background_products as $key => $product)
                    <div class="welcome-background-item">
                        <img src="{{ $product->downsizedImage() }}" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div id="welcome-content">
        <div id="double_action">
            <a href="{{ route('storefront') }}">
                <div id="double_action_left" class="double_action_item" style="background: url('/images/misc/cassettes.jpg') center center / cover;">
                    <div>
                        <h2>Take me to the store</h2>
                    </div>
                </div>
            </a>
            <a href="{{ route('storefront.random') }}">
                <div id="double_action_left" class="double_action_item" style="background: url('/images/misc/live_gig.jpg') center center / cover;">
                    <div>
                        <h2>Help me discover something new.</h2>
                    </div>
                </div>
            </a>
        </div>
        <div id="preamble">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="title">Proudly supporting independent artists.</h1>
                    </div>
                    <div class="col-xs-12" id="preamble-text">
                        <p>
                            We like music, but what we like more than music is making sure that Artists who create it are paid fairly.
                        </p>
                        <p>
                            Beat Fund wants to make a difference, our vision is to offer all the tools an Artist needs 100% free, with a revenue
                            sharing policy that's fair.
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