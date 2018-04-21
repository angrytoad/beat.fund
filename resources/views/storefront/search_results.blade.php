@extends('layouts.app')

@section('title', 'Showing products for '.$search)


@section('content')
<div id="storefront" class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('storefront.search') }}
    <div id="search_results_wrapper">
        @include('storefront._storefront_partials.search_and_cart')
        @include('storefront._storefront_partials.search_results')
    </div>
</div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection