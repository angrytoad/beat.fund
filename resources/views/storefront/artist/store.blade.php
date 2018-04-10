@extends('layouts.app')

@section('title', $artist->artist_name.'\'s Store')
@section('meta_description', $artist->plaintextBio())

@section('content')
<div id="artist-store" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('artist.store',$artist) }}
    <div class="row">
        <div class="col-xs-12">
            <div class="banner animated fadeIn" style="background: url({{ $store->banner_url }})">
                <div class="banner-text">{{ $artist->artist_name }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>{{ $artist->artist_name }}</h1><hr />
                    <div id="artist-store-bio">
                        {!! $artist->artist_bio !!}
                    </div>
                </div>
            </div>
            @if(count($store->recentAdditions(3)) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Recent Additions
                    </div>
                    <div class="panel-body">
                        <div id="artist-store-recent-additions">
                            @foreach($store->recentAdditions(3) as $product)
                                <a href="{{ route('artist.store.product',[$store->slug,$product->id]) }}">
                                    <div class="artist-store-recent-addition">
                                        <div class="product-image"
                                             @if($product->image_key)
                                             style="background:url({{ $product->image_url }})"
                                             @else
                                             style="background:url('/images/no_image.png')"
                                                @endif
                                        >
                                            <div class="product-image-item-count">
                                                <i class="fas fa-music"></i> {{ count($product->items) }}
                                            </div>
                                            <div class="product-image-item-price">
                                                @if($product->price === null)
                                                    PWYW
                                                    @else
                                                    &pound;{{ number_format($product->price/100,2) }}
                                                @endif
                                            </div>
                                        </div>
                                        <p class="product-name">{{ $product->name }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    Discography
                </div>
                <div class="panel-body">
                    <div id="artist-store-all-products">
                        @foreach($store->liveProducts() as $product)
                            <a href="{{ route('artist.store.product',[$store->slug,$product->id]) }}">
                                <div class="artist-store-product">
                                    <div class="product-image"
                                         @if($product->image_key)
                                         style="background:url({{ $product->image_url }})"
                                         @else
                                         style="background:url('/images/no_image.png')"
                                            @endif
                                    >
                                        <div class="product-image-item-count">
                                            <i class="fas fa-music"></i> {{ count($product->items) }}
                                        </div>
                                        <div class="product-image-item-price">
                                            @if($product->price === null)
                                                PWYW
                                                @else
                                                &pound;{{ number_format($product->price/100,2) }}
                                            @endif
                                        </div>
                                    </div>
                                    <p class="product-name">{{ $product->name }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default hidden-sm hidden-xs">
                <div id="artist-store-avatar" style="background: url({{ $store->avatar_url }})"></div>
            </div>
            @if(count($artist->profile_links) > 0)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="artist-store-links">
                            @foreach($artist->profile_links as $profile_link)
                                <div class="artist-store-link">
                                    <a href="{{ $profile_link->link }}" target="_blank">
                                        <i class="fab fa-{{$profile_link->type}}"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="artist-website-link">
                        <h4 class="text-muted">Artist Website</h4><hr />
                        <a target="_blank" href="{{ $artist->artist_website }}">{{ $artist->artist_website }}</a>
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