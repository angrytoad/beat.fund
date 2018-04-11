@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('storefront.checkout') }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Checkout</div>
                <div class="panel-body">

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