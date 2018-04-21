@extends('layouts.app')

@section('title', 'Store')

@section('content')
<div id="storefront" class="container storefront-basic">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('store') }}
    <div id="storefront-main-basic">
        @include('storefront._storefront_partials.search_and_cart')
        @include('storefront._storefront_partials.recently_added_products')
    </div>
</div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection