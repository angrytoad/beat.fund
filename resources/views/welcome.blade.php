@extends('layouts.app_basic')

@section('title', 'Beat Fund - Supporting Independent Artists')
@section('meta_description','One music lovers dream to support independent artists across the globe with a fairer deal and a range tools to sell and manage your music easily.')
@section('og:image', url()->to('/images/beatfund/beat_fund_banner.jpg'))

@section('content')
<div id="welcome">
    <div id="welcome-banner">
        <div id="welcome-container">
            <div id="welcome-container-child">
                <div id="welcome-container-child-container">
                    <h1 id="title">Beat Fund</h1>
                    <h3 id="subtitle">Supporting independent artists for FREE, FOREVER</h3>
                    <div id="store-sampler">
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
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script>

    </script>
@endsection