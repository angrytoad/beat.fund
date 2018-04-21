@extends('layouts.app')

@section('title', 'Store')

@section('content')
<div id="storefront" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('storefront') }}
    <div id="storefront-main">
        @include('storefront._storefront_partials.featured_albums')
        @include('storefront._storefront_partials.search_and_cart')
        @include('storefront._storefront_partials.artist_recommendation')
        @include('storefront._storefront_partials.product_recommendation')
        @include('storefront._storefront_partials.featured_artists_banner')
        @include('storefront._storefront_partials.best_selling_products')
        @include('storefront._storefront_partials.best_selling_artists')
        @include('storefront._storefront_partials.random_artist_product')
        @include('storefront._storefront_partials.popular_tags')
        @include('storefront._storefront_partials.random_artist_bio')
        @include('storefront._storefront_partials.recently_bought')
        @include('storefront._storefront_partials.recently_added_products')
    </div>
</div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection