@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('artist.store.product',$product->store->user->profile,$product) }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $product->name }}</div>
                <div class="panel-body">
                   Coming soon...
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